<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\VendorController;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSales = Order::sum('total_price');
        $totalOrders = Order::count();
        $activeVendors = Vendor::whereNotNull('deleted_at')->count();
        $productsListed = Product::count();
        
        return view('admin.dashboard', compact('totalSales', 'totalOrders', 'activeVendors', 'productsListed'));
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