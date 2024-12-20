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

        // Attempt login with the default 'web' guard
        if (Auth::guard('web')->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], $request->remember)) {

            $user = Auth::user();

            // Redirect based on role_id
            if ($user->role_id == 1) { // Customer
                return redirect()->route('shop.index');
            } elseif ($user->role_id == 2) { // Vendor
                return redirect()->route('vendor.dashboard');
            } else {
                // Logout unknown roles
                Auth::logout();
                throw ValidationException::withMessages([
                    'email' => ['Unauthorized role.'],
                ]);
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