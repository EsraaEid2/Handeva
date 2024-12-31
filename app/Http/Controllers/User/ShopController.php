<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['primaryImage', 'reviews'])
            ->whereNull('deleted_at')
            ->where('is_visible', 1);
    
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }
    
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('title', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('title', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        }
    
        $products = $query->paginate($request->input('per_page', 9));
    
        // حساب متوسط التقييم
        foreach ($products as $product) {
            $product->avg_rating = $product->reviews->avg('rating');
        }
    
        $categories = Category::all();
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');
        $priceRanges = $this->generatePriceRanges($minPrice, $maxPrice);
    
        if ($request->ajax()) {
            return response()->json([
                'products' => $products,
            ]);
        }
    
        return view('theme.Collections', compact('products', 'categories', 'priceRanges'));
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
    
}    