<?php

namespace App\Http\Controllers\User;

use App\Models\Review;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ThemeController extends Controller
{
    public function login_register(){
        if (Auth::guard('web')->check()) {
            return redirect()->route('collections')->with('info', 'You are already logged in.');
        }
        if (Auth::guard('vendor')->check()) {
            return redirect()->route('vendor.dashboard')->with('info', 'You are already logged in.');
        }
        return view('theme.login-register');
    }
    public function compare(){
        return view('theme.compare');
    }
    public function contact(){
        return view('theme.contact');
    }
    public function my_account(){
        return view('theme.my-account');
    }
    public function shop(){
        return view('theme.Collections');
    }
    public function single_product(){
        return view('theme.single-product');
    }
    public function wishlist(){
        return view('theme.wishlist');
    }
    public function about(){
        return view('theme.about');
    }
    
}