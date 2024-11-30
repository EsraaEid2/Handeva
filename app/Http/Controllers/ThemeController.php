<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index(){
        return view('theme.index');
    }
    public function login_register(){
        return view('theme.login-register');
    }
    public function cart(){
        return view('theme.cart');
    }
    public function checkout(){
        return view('theme.checkout');
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
        return view('theme.shop');
    }
    public function single_product(){
        return view('theme.single-product');
    }
    public function wishlist(){
        return view('theme.wishlist');
    }
    
}