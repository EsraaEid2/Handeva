<?php

namespace App\Http\Controllers\User\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserLoginController extends Controller
{
    /**
     * Handle login for both vendors and customers.
     */
    public function checkLogin(Request $request)
    {
        // dd($request);
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);
    
        // Attempt login based on the role
        // Check if user is customer or vendor
        $user = User::where('email', $request->email)->first(); // أو إذا كان عندك جدول للبائعين استخدمه هنا
        // dd($user,"test");
        
        if ($user) {
            // dd($user->role_id );
            // إذا كان عميل، استخدم guard: web
            if ($user->role_id == 1) { 
                if (Auth::guard('web')->attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ], $request->remember)) {
                    return redirect()->route('collections');
                }
            }
            // إذا كان بائع، استخدم guard: vendor
            elseif ($user->role_id == 2) { 
                // dd(Auth::guard('vendor')->attempt([
                //     'email' => $request->email,
                //     'password' => $request->password,
                // ], $request->remember));
                if (Auth::guard('vendor')->attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ], $request->remember)) {
                    // dd("testif condition ");
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
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
        } elseif (Auth::guard('vendor')->check()) {
            Auth::guard('vendor')->logout();
        }
    
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect()->route('user.home');
    }
    
}