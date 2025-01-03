<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        // تحديد الفئة الحالية (إذا تم تمريرها)
        $currentCategory = $request->input('category_id') 
            ? Category::find($request->input('category_id')) 
            : null;
        
        // بناء استعلام المنتجات
        $query = Product::with(['primaryImage', 'reviews'])
            ->whereNull('deleted_at') // شرط محو المنتجات المحذوفة
            ->where('is_visible', 1);  // التأكد من أن المنتج مرئي
        
        // فلترة حسب الفئة الحالية
        if ($currentCategory) {
            $query->where('category_id', $currentCategory->id);
        }
    
        // إضافة وظيفة البحث
        if ($request->has('query') && $request->query('query')) {
            $searchQuery = $request->query('query');
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('description', 'LIKE', "%{$searchQuery}%");
            });
        }
    
        // إضافة فلاتر أخرى بناءً على التايب
        if ($request->has('type')) {
            $type = $request->input('type');
            switch ($type) {
                case 'custom':
                    $query->where('is_customizable', 1);
                    break;
                case 'traditional':
                    $query->where('is_traditional', 1);
                    break;
                case 'sale':
                    $query->whereNotNull('price_after_discount');
                    break;
            }
        }
    
        // إضافة الفلاتر الأخرى مثل الأسعار
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween(DB::raw('COALESCE(price_after_discount, price)'), [$request->min_price, $request->max_price]);
        }
    
        // فرز النتائج
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('title', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy(DB::raw('COALESCE(price_after_discount, price)'), 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy(DB::raw('COALESCE(price_after_discount, price)'), 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }
    
        // تنفيذ الاستعلام وجلب النتائج
        $products = $query->paginate($request->input('per_page', 9));
        
        // حساب التقييم لكل منتج
        foreach ($products as $product) {
            $product->avg_rating = $product->reviews->avg('rating');
        }
    
        // جلب الأقسام غير المحذوفة
        $categories = Category::whereNull('deleted_at')->get();
        
        // نطاق الأسعار
        $minPrice = Product::min(DB::raw('COALESCE(price_after_discount, price)'));
        $maxPrice = Product::max(DB::raw('COALESCE(price_after_discount, price)'));
        $priceRanges = $this->generatePriceRanges($minPrice, $maxPrice);
        
        // إرجاع الفيو مع تمرير الفئة الحالية ونتائج البحث إذا كانت موجودة
        return view('theme.Collections', compact('products', 'categories', 'priceRanges', 'currentCategory'));
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
    
    public function search(Request $request)
    {
        // Validate the search query
        $request->validate([
            'query' => 'required|string|max:255',
        ]);

        // Retrieve the search query
        $query = $request->input('query');

        // Search products by title or description
        $products = Product::where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->where('is_deleted', 0) // Exclude soft-deleted products
            ->paginate(8); // Adjust pagination as needed

        // Return the shop view with search results
        return view('collections', compact('products', 'query'));
    }
    
}    