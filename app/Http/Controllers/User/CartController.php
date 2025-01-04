<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
    
        // Retrieve cart from session or initialize it
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productId])) {
            // If the product is already in the cart, increase the quantity
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Fetch the product details
            $product = Product::findOrFail($productId);
    
            // Add new product to the cart
            $cart[$productId] = [
                'product_id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $quantity,
                'image_url' => $product->primaryImage ? $product->primaryImage->image_url : 'img/default.jpg',
            ];
        }
    
        // Save the updated cart to session
        session()->put('cart', $cart);
    
        // Calculate the total cart count
        $cartCount = array_sum(array_column($cart, 'quantity'));
    
        // Prepare the success message
        session()->flash('successAdd', "{$cart[$productId]['title']} has been added to your cart!");
    
        return response()->json([
            'message' => session('successAdd'), // Retrieve the message from the session
            'cart' => $cart,                   // Updated cart
            'cart_count' => $cartCount,        // Total cart count
        ]);
    }
    

    
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        
        $cartItems = Product::whereIn('id', array_keys($cart))
            ->with('primaryImage')
            ->get()
            ->map(function ($product) use ($cart) {
                return [
                    'product_id' => $product->id,
                    'title' => $product->title,
                    'price' => $product->price,
                    'stock_quantity' => $product->stock_quantity,
                    'quantity' => $cart[$product->id]['quantity'],
                    'image_url' => $product->primaryImage ? $product->primaryImage->image_url : 'img/default.jpg',
                    'total_price' => $product->price * $cart[$product->id]['quantity'],
                ];
            });
    
        $totalPrice = $cartItems->sum('total_price');
        $shipping = 5; // قيمة الشحن الثابتة
        $total = $totalPrice + $shipping;
    
        return view('theme.cart', compact('cartItems', 'totalPrice', 'shipping', 'total'));
    }
    
    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);

            $itemTotal = $cart[$productId]['price'] * $quantity;

            $subtotal = array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);

            $shipping = 5; // قيمة الشحن الثابتة
            $total = $subtotal + $shipping;

            $cartCount = array_sum(array_column($cart, 'quantity')); // حساب العدد الإجمالي للعناصر

            return response()->json([
                'subtotal' => $subtotal,
                'total' => $total,
                'itemTotal' => $itemTotal,
                'cart_count' => $cartCount, // إرجاع عدد العناصر
            ]);
        }

        return response()->json(['error' => 'Product not found in cart'], 404);
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            session()->put('cart', $cart);

            $subtotal = array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);

            $shipping = 5; // قيمة الشحن
            $total = $subtotal + $shipping;

            $cartCount = array_sum(array_column($cart, 'quantity')); // حساب العدد الإجمالي للعناصر

            return response()->json([
                'success' => true,
                'subtotal' => $subtotal,
                'total' => $total,
                'cart_count' => $cartCount, // إرجاع عدد العناصر
            ]);
        }

        return response()->json(['success' => false]);
    }
}