<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    // Show vendor registration form
    public function registerForm()
    {
        return view('vendor.register');
    }

    // Register vendor and store in the database
    public function register(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'password' => 'required|string|min:8|confirmed',
            'phone' => 'nullable|string|max:20',
            'social_links' => 'nullable|array', // Can be an array of social links
            'bio' => 'nullable|string',
            'profile_pic' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        if ($request->hasFile('profile_pic')) {
            $profilePicPath = $request->file('profile_pic')->store('profile_pics', 'public');
        } else {
            $profilePicPath = null;
        }

        // Prepare the vendor data
        $vendor = new Vendor();
        $vendor->first_name = $request->first_name;
        $vendor->last_name = $request->last_name;
        $vendor->email = $request->email;
        $vendor->password = Hash::make($request->password);
        $vendor->phone = $request->phone;
        $vendor->social_links = json_encode($request->social_links); // Store as JSON
        $vendor->bio = $request->bio;
        $vendor->profile_pic = $profilePicPath;
        $vendor->role_id = 2; // Assuming 2 is the role ID for vendors
        $vendor->save();

        // Redirect to the vendor dashboard or login page
        return redirect()->route('vendor.dashboard');
    }
}