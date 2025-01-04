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
        // Retrieve cart from session
        $cart = session()->get('cart', []);

        // Ensure each item has 'total_price'
        foreach ($cart as $key => $item) {
            if (!isset($item['total_price'])) {
                $cart[$key]['total_price'] = $item['price'] * $item['quantity'];
            }
        }

        $totalPrice = array_sum(array_column($cart, 'total_price'));
        $shippingCost = 5;
        $user = auth()->user();

        return view('theme.checkout', compact('cart', 'totalPrice', 'user', 'shippingCost'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty.');
        }

        // Update user information
        $user = auth()->user();
        $user->update($request->only(['first_name', 'last_name', 'email', 'address', 'phone_number', 'age']));

        // Calculate total price of cart items
        $totalPrice = array_sum(array_map(function ($item) {
            return $item['price'] * $item['quantity'];
        }, $cart));

        // Add shipping cost
        $shippingCost = 5;
        $totalPrice += $shippingCost;

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'payment_method' => $request->payment_method,
        ]);

        // Create order items
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price_at_time' => $item['price'],
                'total_price' => $item['price'] * $item['quantity'],
            ]);
        }

        // Handle Stripe payment
        if ($request->payment_method === 'stripe') {
            return redirect()->route('checkout.stripe.payment', ['orderId' => $order->id]);
        }

        // Update order status for cash on delivery
        $order->update([
            'status' => 'processing',
            'payment_status' => 'paid_on_delivery',
        ]);

        // Clear cart from session
        session()->forget('cart');

        // Flash success message
        session()->flash('orderSuccess', 'Thank you for your order!');

        return redirect()->route('collections');
    }
    
    
}