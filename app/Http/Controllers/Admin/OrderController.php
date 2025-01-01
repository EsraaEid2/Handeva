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
         $status = $request->input('status'); // الحصول على قيمة الحالة من الـ request
     
         $orders = Order::with('user', 'orderItems.product')
                        ->when($status, function ($query) use ($status) {
                            $query->where('status', $status); // فلترة الطلبات بناءً على الحالة المختارة
                        })
                        ->latest()
                        ->get(); // استخدم get() بدلاً من paginate()
         
         return view('admin.orders.index', compact('orders'));
     }
     
     
 
     // Display order details
     public function show(Order $order)
     {
         $order->load(['orderItems.product', 'user']);
         return view('admin.orders.show', compact('order'));
     }

    // Method to update the order status
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,delivered,cancelled', // Correct enum values
        ]);
        

        // Update the order status
        $order->status = $request->status;
        $order->save();

        // Redirect back with success message
        return redirect()->back()->with('successUpdate', 'Order status updated successfully.');
    }


}