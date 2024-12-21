<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserLoginController extends Controller
{
    /**
     * Handle login for both vendors and customers.
     */
    public function checkLogin(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Attempt login based on the role
        // Check if user is customer or vendor
        $user = \App\Models\User::where('email', $request->email)->first(); // أو إذا كان عندك جدول للبائعين استخدمه هنا
    
        if ($user) {
            // إذا كان عميل، استخدم guard: web
            if ($user->role_id == 1) { 
                if (Auth::guard('web')->attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ], $request->remember)) {
                    return redirect()->route('shop.index');
                }
            }
            // إذا كان بائع، استخدم guard: vendor
            elseif ($user->role_id == 2) { 
                if (Auth::guard('vendor')->attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ], $request->remember)) {
                    return redirect()->route('vendor.dashboard');
                }
            }
        }
    
        // If authentication fails
        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }
    
    /**
     * Handle logout for both customers and vendors.
     */
    public function logout(Request $request)
    {
        Auth::guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('theme.home');
    }
}