<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

     // Display list of orders
     public function index(Request $request)
     {
         $search = $request->input('search');
         $orders = Order::with('user')
             ->when($search, function ($query) use ($search) {
                 $query->where('id', 'like', "%$search%")
                       ->orWhereHas('user', function ($query) use ($search) {
                           $query->where('name', 'like', "%$search%");
                       });
             })
             ->latest()
             ->paginate(10); // Use pagination
     
         return view('admin.orders.index', compact('orders'));
     }
     
 
     // Display order details
     public function show(Order $order)
     {
         $order->load(['orderItems.product', 'user']);
         return view('admin.orders.show', compact('order'));
     }
     
    public function placeOrder(Request $request)
    {
        $user = Auth::user();
        $cartItems = $request->input('cart_items'); // Cart items from the request (array)

        $totalPrice = 0;
        $orderItems = [];

        foreach ($cartItems as $item) {
            $product = Product::findOrFail($item['product_id']); // Ensure product exists
            $quantity = $item['quantity'];

            if ($quantity > $product->stock_quantity) {
                return back()->withErrors(['message' => "Not enough stock for {$product->title}."]);
            }

            // Reduce stock quantity
            $product->decrement('stock_quantity', $quantity);

            // Calculate total price for this item
            $priceAtTime = $product->price_after_discount ?? $product->price;
            $totalPrice += $priceAtTime * $quantity;

            $orderItems[] = [
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price_at_time' => $priceAtTime,
                'total_price' => $priceAtTime * $quantity,
            ];
        }

        // Create the order
        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'notes' => $request->input('notes'),
        ]);

        // Add items to the order
        foreach ($orderItems as $item) {
            $order->orderItems()->create($item);
        }

        return redirect()->route('orders.show', $order->id)
                         ->with('success', 'Order placed successfully!');
    }


}