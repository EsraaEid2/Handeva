<?php
// Admin routes

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderItemController;
use App\Http\Controllers\Admin\ProductImageController;


// Route::get('/', function () {

//     return view('welcome');
// });

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {

    // Admin Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    // Users Dashboard Route
    Route::get('users', [UserController::class, 'index'])->name('admin.users.index');
    Route::post('users', [UserController::class, 'store'])->name('admin.users.store');
    Route::put('users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');


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
    
    
    // Routes for managing product images
    Route::resource('product_images', ProductImageController::class);
    Route::get('products/{productId}/images', [ProductImageController::class, 'index'])->name('admin.product_images.index');
    Route::get('products/{productId}/images/create', [ProductImageController::class, 'create'])->name('admin.product_images.create');
    Route::post('products/{productId}/images', [ProductImageController::class, 'store'])->name('admin.product_images.store');
    Route::delete('products/{productId}/images/{imageId}', [ProductImageController::class, 'destroy'])->name('admin.product_images.destroy');
    
    // Contact Us Management Routes
    Route::get('/contactus', [ContactUsController::class, 'index'])->name('contactus.index');
    Route::get('/contactus/{id}', [ContactUsController::class, 'show'])->name('contactus.show');
    Route::put('/contactus/{id}', [ContactUsController::class, 'update'])->name('contactus.update');
    Route::put('/contactus/{id}/mark-read', [ContactUsController::class, 'markAsRead']);


    
    // Roles Management Routes
    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::delete('/admin/roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');

    
    // Route::resource('roles', RoleController::class);

    // Vendors Management Routes
    Route::get('vendors', [VendorController::class, 'index'])->name('admin.vendors.index');
    Route::get('vendors/create', [VendorController::class, 'create'])->name('admin.vendors.create');
    Route::post('vendors', [VendorController::class, 'store'])->name('admin.vendors.store');
    Route::get('vendors/{vendor}/edit', [VendorController::class, 'edit'])->name('admin.vendors.edit');
    Route::put('vendors/{vendor}', [VendorController::class, 'update'])->name('admin.vendors.update');
    Route::delete('vendors/{vendor}', [VendorController::class, 'destroy'])->name('admin.vendors.destroy');

    // Reviews Management Routes
    Route::get('reviews', [ReviewController::class, 'index'])->name('admin.reviews.index');
    Route::post('reviews/{reviewId}/approve', [ReviewController::class, 'approve'])->name('admin.reviews.approve');
    Route::post('reviews/{reviewId}/reject', [ReviewController::class, 'reject'])->name('admin.reviews.reject');

    // Orders Management Routes
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');


    // Admin Profile Routes
    Route::get('profile', [DashboardController::class, 'editProfile'])->name('admin.profile');
    Route::put('profile', [DashboardController::class, 'updateProfile'])->name('admin.updateProfile');

    // Admin logout route
    // Route::post('logout', [DashboardController::class, 'logout'])->name('admin.logout');


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

// Admin Messages Route
Route::get('admin/messages', [DashboardController::class, 'showMessages'])->name('admin.messages');

Route::get('admin/messages/count', [DashboardController::class, 'getUnreadMessagesCount']);