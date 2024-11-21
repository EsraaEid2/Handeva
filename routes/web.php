<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ContactUsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->middleware(['auth','isAdmin'])->group(function () {
    
    // Admin Dashboard Route
    Route::get('/dashboard', [DashboardController::class, 'index']);
    
    
    // Category Management Routes
    Route::get('/category',[CategoryController::class ,'index']);
    Route::get('add-category',[CategoryController::class ,'create']);
    Route::post('add-category',[CategoryController::class ,'store']);
    Route::get('edit-category/{category_id}',[CategoryController::class ,'edit']);
    Route::put('update-category/{category_id}',[CategoryController::class ,'update']);
    Route::get('delete-category/{category_id}',[CategoryController::class ,'destroy']);


    // Contact us Management Routes
    Route::get('/contact-us', [ContactUsController::class, 'index'])->name('contact_us.index');
    Route::get('/contact-us/{id}', [ContactUsController::class, 'show'])->name('contact_us.show');
    Route::delete('/contact-us/{id}', [ContactUsController::class, 'destroy'])->name('contact_us.destroy');

    
});