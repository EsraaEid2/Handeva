<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VendorController;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        // Fetch total users, vendors, products, and orders count
        $totalUsers = User::count();
        $totalVendors = Vendor::count();
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        
        // Fetch vendors with their product count and total sales
        $topVendors = DB::table('vendors')
            ->join('products', 'vendors.id', '=', 'products.vendor_id')
            ->leftJoin('order_items', 'products.id', '=', 'order_items.product_id')
            ->select(
                'vendors.id as vendor_id',
                DB::raw("CONCAT(vendors.first_name, ' ', vendors.last_name) as vendor_name"),
                'vendors.email as vendor_email',
                DB::raw('COUNT(products.id) as total_uploaded_products'),
                DB::raw('SUM(order_items.quantity) as total_sold_products'),
                DB::raw('IFNULL(products.price_after_discount, products.price) as product_price')
            )
            ->groupBy('vendors.id', 'vendors.first_name', 'vendors.last_name', 'vendors.email', 'products.price', 'products.price_after_discount')
            ->orderByDesc(DB::raw('SUM(order_items.quantity)'))
            ->paginate(10);
    
        // Fetch data for products by visibility
        $productsByVisibility = DB::table('products')
            ->select('is_visible', DB::raw('COUNT(id) as product_count'))
            ->groupBy('is_visible')
            ->get();
    
        // Prepare data for the visibility chart
        $visibilityLabels = [];
        $visibilityCounts = [];
        foreach ($productsByVisibility as $product) {
            $visibilityLabels[] = $product->is_visible ? 'Visible' : 'Not Visible';
            $visibilityCounts[] = $product->product_count;
        }
    
        // Fetch categories and product counts by category
        $categories = DB::table('categories')->get();
        $productCountsByCategory = [];
        foreach ($categories as $category) {
            $count = DB::table('products')
                ->where('category_id', $category->id)
                ->whereNull('deleted_at') // Check non-deleted products
                ->count();
            $productCountsByCategory[] = $count;
        }
    
        // Convert category data to a format that can be passed to JavaScript
        $categoryLabels = $categories->pluck('name')->toArray();  // Assuming category has a 'name' field
        $categoryCounts = $productCountsByCategory;
    
        // Pass the data to the view
        return view('admin.dashboard', compact(
            'visibilityLabels',
            'totalUsers',
            'totalVendors',
            'totalOrders',
            'totalProducts',
            'topVendors',
            'visibilityCounts',
            'categoryLabels',
            'categoryCounts'
        ));
    }
    
    public function getUnreadMessagesCount()
    {
        $unreadCount = ContactUs::where('is_read', 0)->count();  // Assuming 'is_read' is a column
        return response()->json(['unread_count' => $unreadCount]);
    }

    public function editProfile()
    {
        // Get the authenticated user
        $admin = Auth::user();
    
        return view('profile', compact('admin'));
    }
    
    public function updateProfile(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Get the authenticated user
        $admin = Auth::user();

        // Update first name, last name, and email
        $admin->first_name = $request->input('first_name');
        $admin->last_name = $request->input('last_name');
        $admin->email = $request->input('email');

        // Update password if provided
        if ($request->filled('password')) {
            $admin->password = bcrypt($request->input('password'));
        }

        // Update profile picture if provided
        // if ($request->hasFile('profile_picture')) {
        //     // Delete old picture if it exists
        //     if ($admin->profile_picture) {
        //         Storage::delete('public/' . $admin->profile_picture);
        //     }
        //     $path = $request->file('profile_picture')->store('profile_pictures', 'public');
        //     $admin->profile_picture = $path;
        // }

        // Save the updated data
        $admin->save();

        return redirect()->route('admin.profile')->with('successUpdate', 'Profile updated successfully!');

    }
    
    public function logout(Request $request)
    {
        $guard = Auth::guard('web');
    
        $guard->logout();
    
        $request->session()->invalidate();

        $request->session()->regenerateToken();
    
        // Redirect to the appropriate route
        return redirect()->route('login');
    }
    
    

}