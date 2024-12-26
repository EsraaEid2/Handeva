<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\ThemeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\Vendor\VendorController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\ProductController as UserProductController;



Route::post('login', [UserLoginController::class, 'checkLogin'])->name('checkLogin');
Route::post('user/logout', [UserLoginController::class, 'logout'])->name('userLogout');

Route::post('register', [UserRegisterController::class, 'store'])->name('store');
Route::get('/new-products', [UserHomeController::class, 'index'])->name('new.products');
Route::get('/',[UserHomeController::class,'index'])->name('user.home');

Route::get('/collections/{type?}', [ShopController::class, 'index'])->name('collections');


Route::get('collections/product/{id}', [UserProductController::class, 'showProductDetails'])->name('product.showProductDetails');
Route::post('/cart/add', [OrderController::class, 'addToCart'])->name('cart.add');
Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');
Route::delete('/wishlist/remove/{product_id}', [WishlistController::class, 'removeProduct'])->name('wishlist.remove');

Route::get('/test-session', function () {
    session()->put('wishlist', [11, 12,13]);
    return session()->get('wishlist');
});


// Customer routes
Route::middleware(['auth:', 'role:1'])->group(function () {

    // Other customer-specific routes
});

// Vendor routes
Route::middleware(['auth:vendor', 'role:2'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::post('/vendor/update-account', [VendorController::class, 'updateAccount'])->name('vendor.updateAccount');
    Route::post('/vendor/upload-product', [VendorController::class, 'uploadProduct'])->name('vendor.uploadProduct');
    Route::put('/vendor/products/{id}', [VendorController::class, 'updateProduct'])->name('vendor.products.update');
    Route::delete('/vendor/products/{id}', [VendorController::class, 'destroyProduct'])->name('vendor.products.destroy');
});


Route::controller(ThemeController::class)->name('theme.')->group(function(){
  
    Route::get('/login-register',[ThemeController::class,'login_register'])->name('login_register'); 
    Route::get('/about','about')->name('about');// no view
    Route::get('/cart','cart')->name('cart');
    Route::get('/checkout','checkout')->name('checkout');
    Route::get('/compare','compare')->name('compare');
    Route::get('/contact','contact')->name('contact'); 
    Route::get('/my-account','my_account')->name('my_account');
    Route::get('/single-product','single_product')->name('single_product');
    Route::get('/wishlist','wishlist')->name('wishlist');

});