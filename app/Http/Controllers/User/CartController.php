<?php

namespace App\Http\Controllers\User;

use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class CartController extends Controller
{

    public function addToCart(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $productId = $validatedData['product_id'];
        $quantity = $validatedData['quantity'];
    
        $product = Product::findOrFail($productId);
    
        if ($product->stock_quantity < $quantity) {
            return response()->json([
                'success' => false,
                'message' => __('messages.insufficient_stock'),
            ], 400);
        }
    
        if (auth()->guard('web')->check()) {
            // المستخدم مسجل
            $cart = Cart::firstOrCreate(
                ['user_id' => auth()->id()],
                ['created_at' => now(), 'updated_at' => now()]
            );
    
            $cartItem = $cart->items()->firstWhere('product_id', $productId);
    
            if ($cartItem) {
                $newQuantity = $cartItem->quantity + $quantity;
    
                if ($product->stock_quantity < $newQuantity) {
                    return response()->json([
                        'success' => false,
                        'message' => __('messages.insufficient_stock_for_quantity'),
                    ], 400);
                }
    
                $cartItem->update(['quantity' => $newQuantity]);
            } else {
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                ]);
            }
    
            $cartCount = $cart->items()->sum('quantity');
    
            return response()->json([
                'success' => true,
                'message' => __('messages.cart_product_added_success'),
                'cartCount' => $cartCount,
            ]);
        } else {
            // المستخدم ضيف
            $cart = session()->get('cart', []);
    
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
    
                if ($product->stock_quantity < $cart[$productId]['quantity']) {
                    return response()->json([
                        'success' => false,
                        'message' => __('messages.insufficient_stock_for_quantity'),
                    ], 400);
                }
            } else {
                $cart[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'product_name' => $product->name,
                    'product_price' => $product->price,
                ];
            }
    
            session()->put('cart', $cart);
    
            $cartCount = array_sum(array_column($cart, 'quantity'));
    
            return response()->json([
                'success' => true,
                'message' => __('messages.cart_product_added_success'),
                'cartCount' => $cartCount,
            ]);
        }
    }
    
    
}