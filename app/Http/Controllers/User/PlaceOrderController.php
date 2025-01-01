<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PlaceOrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);
    
        DB::beginTransaction();
    
        try {
            // إنشاء الطلب
            $order = Order::create([
                'user_id' => auth()->id(),
                'status' => 'pending',
                'payment_method' => $request->payment_method,
            ]);
    
            // إضافة عناصر الطلب
            $cartItems = session('cart', []);
            $totalPrice = 0;
    
            foreach ($cartItems as $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_at_time' => $item['price'],
                    'total_price' => $item['quantity'] * $item['price'],
                ]);
    
                $totalPrice += $orderItem->total_price;
            }
    
            // معالجة الدفع إذا كان Stripe
            if ($request->payment_method === 'stripe') {
                return redirect()->route('checkout.stripe', ['order_id' => $order->id]);
            }
    
            // الدفع عند الاستلام
            $order->update(['status' => 'delivered']);
            session()->forget('cart');
            
            return redirect()->route('checkout.success', ['order_id' => $order->id])->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors('Error placing order: ' . $e->getMessage());
        }
    }
    
}