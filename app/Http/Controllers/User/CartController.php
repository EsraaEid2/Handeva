<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);
        // dd($productId);
        $cart = session()->get('cart', []);
    
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $product = Product::findOrFail($productId);
            $cart[$productId] = [
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $quantity,
                'image_url' => $product->primaryImage ? $product->primaryImage->image_url : 'img/default.jpg',
            ];
        }
    
        session()->put('cart', $cart);
    
        return response()->json(['message' => 'Product added to cart!', 'cart' => $cart]);
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
        // dd(session('cart'));
    
        $totalPrice = $cartItems->sum('total_price');
        $shipping = 5; // مثال على قيمة الشحن الثابتة
        $total = $totalPrice + $shipping;
    
        return view('theme.cart', compact('cartItems', 'totalPrice', 'shipping', 'total'));
    }

    public function updateCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        // تحقق من وجود المنتج في الجلسة
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] = $quantity;
            session()->put('cart', $cart);
    
            $itemTotal = $cart[$productId]['price'] * $quantity;
    
            // إعادة حساب الإجماليات
            $subtotal = array_reduce($cart, function ($sum, $item) {
                return $sum + ($item['price'] * $item['quantity']);
            }, 0);
    
            $shipping = 5; // الشحن الثابت
            $total = $subtotal + $shipping;
    
            return response()->json([
                'subtotal' => $subtotal,
                'total' => $total,
                'itemTotal' => $itemTotal,
            ]);
        }
    
        return response()->json(['error' => 'Product not found in cart'], 404);
    }
    
    public function remove($productId)
{
    // تحقق من وجود المنتج في العربة
    $cart = session()->get('cart', []);
    
    if (isset($cart[$productId])) {
        // حذف المنتج من العربة
        unset($cart[$productId]);

        // تحديث العربة في الجلسة
        session()->put('cart', $cart);

        // حساب الإجمالي الجديد
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $total = $subtotal + session()->get('shipping', 0); // إضافة تكاليف الشحن

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }

    return response()->json(['success' => false]);
}




}