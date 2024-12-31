<?php

namespace App\Http\Controllers\User;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    public function showAccount()
    {
        $user = Auth::guard('web')->user();
        if ($user && $user->role_id == 1) { 
            $orders = Order::where('user_id', $user->id)->get();
            return view('theme.my-account', compact('user', 'orders'));
          
        }
        return redirect()->route('user.home')->with('error', 'Unauthorized access.');
    }
    
}