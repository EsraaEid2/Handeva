<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(){
        return view('admin.dashboard');
    }

    public function showMessages()
    {
        // Fetch all messages from contact_us table
        $messages = ContactUs::all();  // Or use pagination: ContactUs::paginate(10)
    
        return view('admin.messages', compact('messages'));
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
    
        return view('admin.profile', compact('admin'));
    }
    
    public function updateProfile(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpg,png,jpeg,gif|max:2048',
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
        if ($request->hasFile('profile_picture')) {
            // Delete old picture if it exists
            if ($admin->profile_picture) {
                Storage::delete('public/' . $admin->profile_picture);
            }
            $path = $request->file('profile_picture')->store('profile_pictures', 'public');
            $admin->profile_picture = $path;
        }

        // Save the updated data
        $admin->save();

        return redirect()->route('admin.profile')->with('status', 'Profile updated successfully!');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/login');  // Redirect to the login page or admin login page
    }

}