<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ShopController;
use App\Http\Controllers\User\ThemeController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\CustomerController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\ContactUsController;
use App\Http\Controllers\User\Vendor\VendorController;
use App\Http\Controllers\User\Auth\UserLoginController;
use App\Http\Controllers\User\Auth\UserRegisterController;
use App\Http\Controllers\User\ProductController as UserProductController;


// Customer routes
Route::middleware(['auth:web'])->group(function () {
    Route::get('/my-account', [CustomerController::class, 'showAccount'])->name('theme.my_account');

    Route::put('/profile/update', [CustomerController::class, 'updateProfile'])->name('user.update.profile');
    Route::put('/profile/password',[CustomerController::class, 'updatePassword'])->name('user.update.password');
    
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::post('/checkout/stripe/payment/{orderId}', [CheckoutController::class, 'processStripePayment'])->name('checkout.stripe.payment');
    Route::post('/checkout/update-user', [CheckoutController::class, 'updateUser'])->name('checkout.updateUser');
});

Route::get('/',[UserHomeController::class,'index'])->name('user.home');
Route::get('/new-products', [UserHomeController::class, 'index'])->name('new.products');
Route::post('register', [UserRegisterController::class, 'store'])->name('store');
Route::post('login', [UserLoginController::class, 'checkLogin'])->name('checkLogin');
Route::post('user/logout', [UserLoginController::class, 'logout'])->name('userLogout');

Route::get('/collections/category/{id}', [UserProductController::class, 'getProductsByCategory'])->name('products.byCategory');

Route::get('/collections/{type?}', [ShopController::class, 'index'])->name('collections');
Route::get('collections/product/{id}', [UserProductController::class, 'showProductDetails'])->name('product.showProductDetails');


Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
Route::delete('/wishlist/remove/{productId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
Route::get('/wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');

// cart routes
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.show');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');

// Review routes
Route::post('/reviews', [ReviewController::class, 'store'])->name('reviews.store');
Route::get('/product/{product}/reviews', [ReviewController::class, 'show'])->name('reviews.show');

// Vendor routes
Route::middleware(['auth:vendor', 'role:2'])->group(function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'index'])->name('vendor.dashboard');
    Route::get('/vendor/profile', [VendorController::class, 'showProfile'])->name('vendor.profile');
    Route::post('/vendor/update-account', [VendorController::class, 'updateAccount'])->name('vendor.updateAccount');
    Route::post('/vendor/upload-product', [VendorController::class, 'uploadProduct'])->name('vendor.uploadProduct');
    Route::put('/vendor/products/{id}', [VendorController::class, 'updateProduct'])->name('vendor.products.update');
    Route::delete('/vendor/products/{id}', [VendorController::class, 'destroyProduct'])->name('vendor.products.destroy');
});

Route::post('user/contact', [ContactUsController::class, 'store'])->name('contact.store');

Route::controller(ThemeController::class)->name('theme.')->group(function(){
  
    Route::get('/login-register',[ThemeController::class,'login_register'])->name('login_register'); 
    Route::get('/about','about')->name('about');
    Route::get('/compare','compare')->name('compare');
    Route::get('/contact','contact')->name('contact'); 
    Route::get('/single-product','single_product')->name('single_product');
  

});