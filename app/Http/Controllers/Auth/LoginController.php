<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    public function authenticated()
    {
        if (Auth::user()->role == '3') { // Admin
            return redirect('admin/dashboard')
                ->with('status', 'Welcome to the Admin Dashboard!');
        } elseif (in_array(Auth::user()->role, ['1', '2'])) { // Customer or Vendor
            return redirect('/home')
                ->with('status', 'You have successfully logged in!');
        } else {
            return redirect('/')
                ->withErrors(['error' => 'Unauthorized access. Please contact support if you believe this is a mistake.']);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }
}