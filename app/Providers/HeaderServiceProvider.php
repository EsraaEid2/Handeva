<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderItem;

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
    // Share data with all views
    View::composer('*', function ($view) {
        $wishlistCount = 0;
        $cartCount = 0;

        if (Auth::check()) {
            // Check if authenticated user is a vendor or a regular user
            $user = Auth::guard('web')->user(); 
            $vendor = Auth::guard('vendor')->user();

            if ($user) {
                // Fetch the user's wishlist count
                $wishlistCount = $user->wishlists()->count();

                // Fetch the current user's cart and count the order items
                $cartCount = OrderItem::whereHas('order', function ($query) use ($user) {
                    $query->where('user_id', $user->id)
                          ->where('status', 'pending')
                          ->whereNull('deleted_at');
                })->count();
            }

            // Vendors won't have wishlist or cart counts
            if ($vendor) {
                $wishlistCount = 0; // Vendors don't have a wishlist
                $cartCount = 0; // Vendors don't have a cart
            }
        }

        $view->with('wishlistCount', $wishlistCount);
        $view->with('cartCount', $cartCount);
    });
}

}