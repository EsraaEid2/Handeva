<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

    public function showProductDetails($id)
    {
        // Fetch the product with its relationships, including approved reviews and customizations
        $product = Product::with([
            'category',
            'vendor',
            'productImages',
            'primaryImage',
            'customizations.customization', // Fetch related customizations
            'reviews' => function ($query) {
                $query->where('status', 'approved');
            },
        ])->findOrFail($id);
    
        // Calculate the average rating for the product
        $product->avg_rating = $product->reviews->avg('rating');
    
        // Return the product details view, passing product, reviews, and customizations
        return view('theme.single-product', [
            'product' => $product,
            'reviews' => $product->reviews,
            'customizations' => $product->customizations->map(function ($customization) {
                return [
                    'id' => $customization->id,
                    'custom_type' => $customization->customization->custom_type, // Assuming 'type' is a field in Customization model
                    'options' => $customization->customization->options, // Assuming 'options' are related to Customization
                ];
            }),
        ]);
    }
    public function getProductsByCategory($id)
    {
        // جلب القسم المطلوب
        $category = Category::findOrFail($id);
    
        // جلب المنتجات المرتبطة بالفئة
        $products = Product::where('category_id', $id)
            ->whereNull('deleted_at') // تحقق من أن المنتجات ليست محذوفة
            ->paginate(9); // paginate by 9 products
    
        // جلب جميع الأقسام
        $categories = Category::all();
    
        // تحديد الفئة الحالية
        $currentCategory = $category; // الفئة الحالية هي الفئة التي تم تمرير الـ id لها
    
        // حساب نطاق الأسعار باستخدام price_after_discount إذا كانت موجودة
        $minPrice = Product::min(DB::raw('COALESCE(price_after_discount, price)'));
        $maxPrice = Product::max(DB::raw('COALESCE(price_after_discount, price)'));
        $priceRanges = $this->generatePriceRanges($minPrice, $maxPrice);
    
        // تمرير البيانات للـ View
        return view('theme.collections', compact('products', 'categories', 'category', 'currentCategory', 'priceRanges'));
    }
    
    private function generatePriceRanges($minPrice, $maxPrice)
    {
        $ranges = [];
        $totalRanges = 5; // Number of price ranges you want
        $rangeStep = ($maxPrice - $minPrice) / $totalRanges; // Calculate step based on range division
    
        for ($i = 0; $i < $totalRanges; $i++) {
            $min = $minPrice + ($rangeStep * $i);
            $max = $i === $totalRanges - 1 ? $maxPrice : $min + $rangeStep; // Ensure the last range goes up to max price
    
            $ranges[] = [
                'min' => round($min, 2),
                'max' => round($max, 2)
            ];
        }
    
        return $ranges;
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



}