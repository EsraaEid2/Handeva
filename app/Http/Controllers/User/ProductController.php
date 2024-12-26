<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Product;

class ProductController extends Controller
{


    public function showProductDetails($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return response()->json([
            'id' => $product->id,
            'title' => $product->title,
            'price' => $product->price,
            'price_after_discount' => $product->price_after_discount,
            'stock_quantity' => $product->stock_quantity,
            'sku' => $product->sku,
            'description' => $product->description,
            'images' => $product->images->map(fn($img) => ['url' => asset($img->image_url)]),
            'colors' => $product->colors, // Assuming you have a `colors` field or relationship
        ]);
    }

    public function addToCart(request $request){
        // validate request
        $request->validate([
        'product_id' =>'required|integer|exists:product,id',
        'quantity' =>'required|integer|min:1'
        ]);

        //Example logic to add product to cart
        $product = Product::findOrFail($request->input('product_id'));

        $cart = Session::get('cart', []);
        $cart[$product->id] = [
            'title' => $product->title,
            'price' => $product->price,
            'quantity' => $request->input('quantity')
        ];
        Session::put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function getFilters() {
        // Fetch categories
        $categories = Category::all();
    
        // Fetch price ranges dynamically based on min & max product prices
        $minPrice = Product::min('price')?? 0;
        $maxPrice = Product::max('price')?? 100;
        $priceRanges = $this->generatePriceRanges($minPrice, $maxPrice);
    
        // Return filters
        return view('theme.collections', [
            'categories' => $categories,
            'priceRanges' => $priceRanges
        ]);
    }

    
// Helper function to create price ranges
private function generatePriceRanges($minPrice, $maxPrice) {
    $ranges = [];
    $step = 10; // Increment price ranges by $10

    for ($i = $minPrice; $i <= $maxPrice; $i += $step) {
        $ranges[] = ['min' => $i, 'max' => $i + $step - 0.01];
    }

    return $ranges;
}

public function shop(Request $request) {
    $query = Product::query();

    // Filter by category
    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    // Filter by product type
    if ($request->type == 'custom') {
        $query->where('is_customizable', 1);
    } elseif ($request->type == 'traditional') {
        $query->where('is_traditional', 1);
    } elseif ($request->type == 'sale') {
        $query->whereNotNull('sale_price');
    }

    // Filter by price range
    if ($request->has('min_price') && $request->has('max_price')) {
        $query->whereBetween('price', [$request->min_price, $request->max_price]);
    }

    // Fetch filtered products
    $products = $query->paginate(8);

    // Fetch categories and price ranges
    $categories = Category::all();
    $minPrice = Product::min('price');
    $maxPrice = Product::max('price');
    $priceRanges = $this->generatePriceRanges($minPrice, $maxPrice);

    return view('theme.collections', compact('products', 'categories', 'priceRanges'));
}


}