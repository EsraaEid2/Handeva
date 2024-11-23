<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Display a list of orders
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }
    
    // Store a new order
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'order_items' => 'required|array', // Ensure order items are provided
            'order_items.*.product_id' => 'required|exists:products,id', // Validate product IDs
            'order_items.*.quantity' => 'required|integer|min:1', // Validate quantity
            'order_items.*.price_at_time' => 'required|numeric', // Validate price
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => 'pending', // Default to pending status
        ]);

        // Create order items
        foreach ($request->order_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price_at_time' => $item['price_at_time'], // Correct field name
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully!',
            'order' => $order
        ], 201); // Return 201 status for created resources
    }

    // Display all orders for a user
    public function showUserOrders($userId)
    {
        $orders = Order::where('user_id', $userId)
            ->with('orderItems.product')
            ->get();

        return response()->json($orders, 200); // Return 200 status
    }

    // Update the status of an order
    public function updateStatus(Request $request, $orderId)
    {
        $request->validate([
            'status' => 'required|in:pending,delivered',
        ]);

        $order = Order::findOrFail($orderId);
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Order status updated successfully!',
            'order' => $order
        ], 200); // Return 200 status for successful update
    }

    // Show a specific order's details along with order items
    public function show(Order $order)
    {
        // Eager load the order items with the product details
        $orderItems = $order->orderItems()->with('product')->get();
        return view('admin.orders.show', compact('order', 'orderItems'));
    }
}