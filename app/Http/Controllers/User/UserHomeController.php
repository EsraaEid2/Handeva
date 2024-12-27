<?php
namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserHomeController extends Controller
{
    public function index()
    {
        // Fetch products with visible status and not deleted, including reviews
        $products = Product::with('reviews') // Get reviews with the product
        ->where('is_visible', 1)
        ->whereNull('deleted_at')
        ->orderBy('created_at', 'DESC')
        ->take(8)
        ->get();

        // Loop through products to calculate avg_rating
        foreach ($products as $product) {
        // Calculate the average rating for each product
        $product->avg_rating = $product->reviews->avg('rating');
        }

        // Fetch top 3 vendors
        $topVendors = DB::table('vendors')
        ->join('products', 'vendors.id', '=', 'products.vendor_id')
        ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
        ->select(
            'vendors.id as vendor_id',
            DB::raw("CONCAT(vendors.first_name, ' ', vendors.last_name) as vendor_name"),
            'vendors.bio',
            DB::raw('COUNT(products.id) as total_uploaded_products'),
            DB::raw('SUM(order_items.quantity) as total_sold_products')
        )
        ->groupBy('vendors.id', 'vendors.first_name', 'vendors.last_name', 'vendors.bio') // Add all non-aggregated fields here
        ->orderByDesc(DB::raw('SUM(order_items.quantity)'))
        ->limit(3)
        ->get();
        // dd($topVendors);
    
        // Pass both products and topVendors to the view
        return view('theme.home', [
        'products' => $products,
        'topVendors' => $topVendors
        ]);
    }
}