<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request) {
        $query = Product::whereNull('deleted_at')->where('is_visible', 1);
    
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
            $query->whereNotNull('price_after_discount');
        }
    
        // Filter by price range
        if ($request->has('min_price') && $request->has('max_price')) {
            $query->whereBetween('price', [$request->min_price, $request->max_price]);
        }
    
        // Sorting
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
    
        // Pagination
        $perPage = $request->input('per_page', 8);
        $products = $query->paginate($perPage);
    
        // Fetch categories and price ranges
        $categories = Category::all();
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');
        $priceRanges = $this->generatePriceRanges($minPrice, $maxPrice);
    
        return view('theme.shop', compact('products', 'categories', 'priceRanges', 'sort', 'perPage'));
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