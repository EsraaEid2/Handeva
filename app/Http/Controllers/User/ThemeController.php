<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Review;


class ThemeController extends Controller
{
    public function login_register(){
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