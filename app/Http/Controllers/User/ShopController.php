<?php

namespace App\Http\Controllers\User;
use App\Models\Product;

use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function index(Request $request, $type = null)
    {
        $query = Product::with('primaryImage')
            ->whereNull('deleted_at')
            ->where('is_visible', 1);
    
        // Filter by product type if provided
        if ($type === 'traditional') {
            $query->where('is_traditional', 1);
        } elseif ($type === 'custom') {
            $query->where('is_customizable', 1);
        } elseif ($type === 'sale') {
            $query->whereNotNull('price_after_discount');
        }
    
        // Apply additional filters if needed
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
    
        // Sorting, price filtering, and pagination remain the same
        $sort = $request->input('sort', 'relevance');
        switch ($sort) {
            case 'Name Ascen':
                $query->orderBy('title', 'asc');
                break;
            case 'Name Decen':
                $query->orderBy('title', 'desc');
                break;
            case 'Price Ascen':
                $query->orderBy('price', 'asc');
                break;
            case 'Price Decen':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
        }
    
        $products = $query->paginate($request->input('per_page', 8));
    
        // Fetch categories and price ranges for the view
        $categories = Category::all();
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');
        $priceRanges = $this->generatePriceRanges($minPrice, $maxPrice);
    
        return view('theme.Collections', compact('products', 'categories', 'priceRanges', 'sort'));
    }
    
    
    // Helper function for price ranges
    private function generatePriceRanges($minPrice, $maxPrice) {
        $ranges = [];
        $step = 10;
    
        for ($i = $minPrice; $i <= $maxPrice; $i += $step) {
            $ranges[] = ['min' => $i, 'max' => $i + $step - 0.01];
        }
    
        return $ranges;
    }
    

    
}