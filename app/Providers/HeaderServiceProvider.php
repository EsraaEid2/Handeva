<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Wishlist;

class HeaderServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            $wishlistCount = 0;
            $cartCount = 0;

            if (Auth::guard('web')->check()) {
                // الحالة: المستخدم مسجل الدخول كـ "web"
                $user = Auth::guard('web')->user();
                
                // عداد الويش ليست للمستخدم من الداتابيس
                $wishlistCount = Wishlist::where('user_id', $user->id)->count();
                
                // عداد الكارت من السيشن
                $cartItems = Session::get('cart', []); // الافتراضي يكون array فارغ
                $cartCount = is_array($cartItems) ? count($cartItems) : 0;

            } elseif (Auth::guard('vendor')->check()) {
                // الحالة: المستخدم مسجل الدخول كـ "vendor"
                $vendor = Auth::guard('vendor')->user();

                // عداد الويش ليست للبائع من الداتابيس
                $wishlistCount = Wishlist::where('vendor_id', $vendor->id)->count();
            } else {
                // الحالة: المستخدم ضيف (غير مسجل الدخول)
                
                // عداد الويش ليست من السيشن
                $wishlistItems = Session::get('wishlist', []); // الافتراضي يكون array فارغ
                $wishlistCount = is_array($wishlistItems) ? count($wishlistItems) : 0;

                // عداد الكارت من السيشن
                $cartItems = Session::get('cart', []); // الافتراضي يكون array فارغ
                $cartCount = is_array($cartItems) ? count($cartItems) : 0;
            }

            // إذا كان العداد لأي منهما صفر، نخفيه في الهيدر
            $view->with([
                'wishlistCount' => $wishlistCount > 0 ? $wishlistCount : null,
                'cartCount' => $cartCount > 0 ? $cartCount : null,
            ]);
        });
    }
}