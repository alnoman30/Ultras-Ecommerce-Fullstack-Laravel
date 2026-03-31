<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;


// Website Routes available to all users
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [HomeController::class, 'shop'])->name('shop');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/cart/checkout', [HomeController::class, 'checkout'])->name('cart.checkout');
Route::get('/cart/order-confirm', [HomeController::class, 'orderConfirm'])->name('order.confirm');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/wishlist', [HomeController::class, 'wishlist'])->name('wishlist');


Route::get('/prod-details', [HomeController::class, 'profDetails'])->name('prod.details');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'user'])->name('dashboard');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // brand routes
    Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brand');
    Route::get('/admin/brands/create', [BrandController::class, 'create'])->name('admin.brand.create');
    Route::post('/admin/brands/store', [BrandController::class, 'store'])->name('admin.brand.store');
    Route::get('/admin/brands/{id}/edit', [BrandController::class, 'edit'])->name('admin.brand.edit');
    Route::put('/admin/brands/{id}/update', [BrandController::class, 'update'])->name('admin.brand.update');
    Route::delete('/admin/brands/{id}/delete', [BrandController::class, 'destroy'])->name('admin.brand.destroy');


    // category routes
    Route::get('/admin/categories', [CategoryController::class, 'index'])->name('admin.category');
    Route::get('/admin/categories/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/admin/categories/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/categories/{id}/edit', [CategoryController::class, 'edit'])->name('admin.category.edit');
    Route::put('/admin/categories/{id}/update', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/categories/{id}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');


    // product routes
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.product');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/admin/products/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/products/{id}/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
    Route::put('/admin/products/{id}/update', [ProductController::class, 'update'])->name('admin.product.update');
    Route::delete('/admin/products/{id}/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');
}); 

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
