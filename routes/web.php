<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


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
    Route::get('/admin/dashboard', function () {
        return view('pages.admin.index');
    })->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
