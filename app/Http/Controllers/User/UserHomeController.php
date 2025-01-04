<?php
namespace App\Http\Controllers\User;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UserHomeController extends Controller
{
    public function index()
    {
        // Fetch products with visible status and not deleted, including reviews
        $products = Product::with('reviews')
            ->where('is_visible', 1)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'DESC')
            ->take(8)
            ->get();
    
        // Calculate avg_rating for each product
        foreach ($products as $product) {
            $product->avg_rating = $product->reviews->avg('rating');
        }
    
        // Fetch top 3 vendors
        $topVendors = DB::table('vendors')
            ->join('products', 'vendors.id', '=', 'products.vendor_id')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->select(
                'vendors.id as vendor_id',
                DB::raw("CONCAT(vendors.first_name, ' ', vendors.last_name) as vendor_name"),
                'vendors.email as vendor_email',
                DB::raw('COUNT(products.id) as total_uploaded_products'),
                DB::raw('SUM(order_items.quantity) as total_sold_products')
            )
            ->groupBy('vendors.id', 'vendors.first_name', 'vendors.last_name', 'vendors.email')
            ->orderByDesc(DB::raw('SUM(order_items.quantity)'))
            ->limit(3)
            ->get();
    
        // Fetch the specific category
        $category = Category::where('name', 'Traditional Accessories')->first();
    
        // Fetch all categories
        $categories = Category::whereNull('deleted_at')->get();
    
        // Check if the category exists and handle accordingly
        if (!$category) {
            abort(404, 'Category "Traditional Accessories" not found');
        }
    
        return view('theme.home', [
            'products' => $products,
            'topVendors' => $topVendors,
            'categories' => $categories,
            'category' => $category,
        ]);
    }
    
    
}