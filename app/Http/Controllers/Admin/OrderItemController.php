<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Update the quantity of an order item
    public function updateQuantity(Request $request, $orderItemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $orderItem = OrderItem::findOrFail($orderItemId);
        $orderItem->quantity = $request->quantity;
        
        // Optionally, adjust the price_at_time if necessary
        $orderItem->price_at_time = $orderItem->product->price; // Use current price if needed
        $orderItem->save();

        return response()->json([
            'message' => 'Order item quantity updated successfully!',
            'order_item' => $orderItem,
        ], 200);
    }

    // Adjust the price of an order item (if necessary, based on new pricing)
    public function adjustPrice(Request $request, $orderItemId)
    {
        $request->validate([
            'new_price' => 'required|numeric|min:0',
        ]);

        $orderItem = OrderItem::findOrFail($orderItemId);
        $orderItem->price_at_time = $request->new_price;
        $orderItem->save();

        return response()->json([
            'message' => 'Order item price adjusted successfully!',
            'order_item' => $orderItem,
        ], 200);
    }

    // Handle returns (adjust quantity or mark as returned)
    public function handleReturn(Request $request, $orderItemId)
    {
        $request->validate([
            'return_quantity' => 'required|integer|min:1',
        ]);

        $orderItem = OrderItem::findOrFail($orderItemId);

        // Adjust the quantity, or mark as returned
        if ($orderItem->quantity >= $request->return_quantity) {
            $orderItem->quantity -= $request->return_quantity;
            $orderItem->save();

            return response()->json([
                'message' => 'Order item return processed successfully!',
                'order_item' => $orderItem,
            ], 200);
        }

        return response()->json([
            'message' => 'Return quantity exceeds the available quantity.',
        ], 400);
    }

    // Delete an order item (if necessary)
    public function destroy($orderItemId)
    {
        $orderItem = OrderItem::findOrFail($orderItemId);
        $orderItem->delete();

        return response()->json([
            'message' => 'Order item deleted successfully!',
        ], 200);
    }
}