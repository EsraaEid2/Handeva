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
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Attempt login based on the role
        $user = User::where('email', $request->email)->first();

        if ($user) {
            // Customer login
            if ($user->role_id == 1) {
                if ($user->is_pending_vendor) {
                    // If the user is pending as a vendor, display a custom message
                    session()->flash('vendorPending', 'Your request to join as a vendor is still under review. You are logged in as a customer for now.');
                    // Log the user in as a customer
                    if (Auth::guard('web')->attempt([
                        'email' => $request->email,
                        'password' => $request->password,
                    ], $request->remember)) {
                        return redirect()->route('collections');
                    }
                } else {
                    // Normal customer login
                    if (Auth::guard('web')->attempt([
                        'email' => $request->email,
                        'password' => $request->password,
                    ], $request->remember)) {
                        session()->flash('success', 'Welcome back, ' . $user->first_name . '!');
                        return redirect()->route('collections');
                    }
                }
            }
            // Vendor login
            elseif ($user->role_id == 2) {
                if (Auth::guard('vendor')->attempt([
                    'email' => $request->email,
                    'password' => $request->password,
                ], $request->remember)) {
                    session()->flash('success', 'Welcome to your dashboard, ' . $user->first_name . '!');
                    return redirect()->route('vendor.dashboard');
                }
            }
        }

        // If authentication fails
        session()->flash('error', 'The provided credentials are incorrect.');
        return redirect()->back()->withInput();
    }

    /**
     * Handle logout for both customers and vendors.
     */
    public function logout(Request $request)
    {
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            session()->flash('success', 'You have been logged out successfully.');
        } elseif (Auth::guard('vendor')->check()) {
            Auth::guard('vendor')->logout();
            session()->flash('success', 'You have been logged out successfully.');
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.home');
    }
}