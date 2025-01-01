<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    public function index()
    {
        // احصل على محتويات السلة
        $cart = session()->get('cart', []);
    
        // التأكد من أن كل عنصر يحتوي على 'total_price'
        foreach ($cart as $key => $item) {
            if (!isset($item['total_price'])) {
                $cart[$key]['total_price'] = $item['price'] * $item['quantity']; // حدد total_price إذا كان مفقودًا
            }
        }
    
        $totalPrice = array_sum(array_column($cart, 'total_price'));
        $user = auth()->user();
        return view('theme.checkout', compact('cart','order','totalPrice','user'));
    }
    
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }
    
        // تحديث بيانات المستخدم
        $user = auth()->user();
        $user->update($request->only(['first_name', 'last_name', 'email', 'address', 'phone_number', 'age']));
    
        // حساب السعر الإجمالي للعناصر في السلة
        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
    
        // إضافة تكلفة الشحن
        $shippingCost = 5;
        $totalPrice += $shippingCost;
    
        // إنشاء الطلب
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);
    
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price_at_time' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'], // حساب السعر الإجمالي
            ]);
        }
        
    
        if ($request->payment_method === 'stripe') {
            return redirect()->route('checkout.stripe.payment', ['orderId' => $order->id]);
        }
        // dd($order->status);
        
        $order->update(['status' => 'processing']);
        $order->update(['payment_status' => 'paid_on_delivery']);
        // dd($order->status);
        // dd($order->payment_status);
        session()->forget('cart'); // تنظيف السلة بعد الطلب
           // تخزين رسالة النجاح في الجلسة
    session()->flash('orderSuccess', 'Thank you for your order!');

    return redirect()->route('checkout.index');

    }
    
    public function processStripePayment(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);
    
        // تهيئة Stripe API
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
    
        // إنشاء جلسة Stripe
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jod',
                        'product_data' => [
                            'name' => 'Order Payment',
                        ],
                        'unit_amount' => $order->total_price * 100, // تحويل المبلغ إلى قروش
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('checkout.success', ['order_id' => $orderId]),
            'cancel_url' => route('checkout.cancel'),
        ]);
    
        // إعادة توجيه المستخدم إلى صفحة الدفع في Stripe
        return redirect()->away($session->url);
    }
    
    public function cancel()
    {
        return view('checkout.cancel')->with('error', 'Payment was cancelled.');
    }
    
}