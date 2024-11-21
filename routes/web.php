<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\OrderItemController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    // Admin Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Users Dashboard Route
    Route::resource('/users',UserController::class);

    // Category Management Routes
    Route::get('/category', [CategoryController::class, 'index']);
    Route::get('add-category', [CategoryController::class, 'create']);
    Route::post('add-category', [CategoryController::class, 'store']);
    Route::get('edit-category/{category_id}', [CategoryController::class, 'edit']);
    Route::put('update-category/{category_id}', [CategoryController::class, 'update']);
    Route::get('delete-category/{category_id}', [CategoryController::class, 'destroy']);

    // Products Management Routes
    Route::get('products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::get('products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
    Route::delete('products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
    Route::get('admin/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('admin/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    
    // Routes for managing product images
    Route::resource('product_images', ProductImageController::class);
    Route::get('products/{productId}/images', [ProductImageController::class, 'index'])->name('admin.product_images.index');
    Route::get('products/{productId}/images/create', [ProductImageController::class, 'create'])->name('admin.product_images.create');
    Route::post('products/{productId}/images', [ProductImageController::class, 'store'])->name('admin.product_images.store');
    Route::delete('products/{productId}/images/{imageId}', [ProductImageController::class, 'destroy'])->name('admin.product_images.destroy');
    
    // Contact Us Management Routes
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact_us.index');
    Route::get('/contact-us/{id}', [ContactUsController::class, 'show'])->name('contact_us.show');
    Route::delete('/contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact_us.destroy');

    // Roles Management Routes
    Route::resource('roles', RoleController::class);

    // Vendors Management Routes
    Route::get('vendors', [VendorController::class, 'index'])->name('admin.vendors.index');
    Route::get('vendors/create', [VendorController::class, 'create'])->name('admin.vendors.create');
    Route::post('vendors', [VendorController::class, 'store'])->name('admin.vendors.store');
    Route::get('vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('admin.vendors.edit');
    Route::put('vendors/{vendor}', [VendorController::class, 'update'])->name('admin.vendors.update');
    Route::delete('vendors/{vendor}', [VendorController::class, 'destroy'])->name('admin.vendors.destroy');

    // Reviews Management Routes
    Route::get('reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::post('reviews/{reviewId}/approve', [ReviewController::class, 'approveReview'])->name('admin.reviews.approve');
    Route::post('reviews/{reviewId}/reject', [ReviewController::class, 'rejectReview'])->name('admin.reviews.reject');

    // Orders Management Routes
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');
    Route::delete('orders/{order}', [OrderController::class, 'destroy'])->name('admin.orders.destroy');
});

Route::middleware('auth')->group(function () {
    
    Route::post('wishlist/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('wishlist/{productId}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::get('wishlist', [WishlistController::class, 'showWishlist'])->name('wishlist.show');
});

// User submits a review for a product
Route::middleware('auth')->group(function () {
    Route::post('product/{productId}/review', [ReviewController::class, 'store'])->name('reviews.store');
});

// User updates order_items
Route::put('/order-items/{orderItemId}/update-quantity', [OrderItemController::class, 'updateQuantity']);
Route::put('/order-items/{orderItemId}/adjust-price', [OrderItemController::class, 'adjustPrice']);
Route::put('/order-items/{orderItemId}/handle-return', [OrderItemController::class, 'handleReturn']);
Route::delete('/order-items/{orderItemId}', [OrderItemController::class, 'destroy']);