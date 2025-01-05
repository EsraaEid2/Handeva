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
        $product = Product::with([
            'category',
            'vendor',
            'productImages',
            'primaryImage',
            'customizations.customization.options',
        ])->findOrFail($id);
    
        $product->avg_rating = DB::table('reviews')
            ->where('product_id', $id)
            ->where('status', 'approved')
            ->avg('rating');
    
        $reviews = DB::table('reviews')
            ->where('product_id', $id)
            ->where('status', 'approved')
            ->paginate(3);
    
        $customizations = $product->customizations->filter(function ($customization) {
            return $customization->customization && $customization->customization->id == 4;
        })->map(function ($customization) {
            return [
                'id' => $customization->customization->id,
                'custom_type' => $customization->customization->custom_type,
                'options' => $customization->customization->options->map(function ($option) {
                    return [
                        'id' => $option->id,
                        'option_value' => $option->option_value,
                    ];
                }),
            ];
        });
    
        if ($customizations->isNotEmpty()) {
            // dd($customizations);
        }
    
        return view('theme.single-product', [
            'product' => $product,
            'reviews' => $reviews,
            'customizations' => $customizations,
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
    public function addToCart(Request $request)
    {
        // Validate the request
        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        // Fetch the product
        $product = Product::findOrFail($request->input('product_id'));
    
        // Retrieve the cart from session
        $cart = Session::get('cart', []);
    
        // Add or update the product in the cart
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->input('quantity');
        } else {
            $cart[$product->id] = [
                'title' => $product->title,
                'price' => $product->price,
                'quantity' => $request->input('quantity'),
            ];
        }
    
        // Save the updated cart back to the session
        Session::put('cart', $cart);
    
        // Set the success message for SweetAlert
        return redirect()->back()->with('successAdd', "{$product->title} has been added to your cart.");
    }
    
    

}