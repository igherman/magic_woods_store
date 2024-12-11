<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Shop\HomeController;
use App\Http\Controllers\Shop\ProductController;
use App\Http\Controllers\Shop\CartController;
use App\Http\Controllers\Shop\CheckoutController;
use App\Http\Controllers\Shop\WishlistController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/categories/{category:slug}', [ProductController::class, 'category'])->name('categories.show');

// Cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/items/{itemId}/increment', [CartController::class, 'incrementQuantity'])->name('cart.increment');
Route::post('/cart/items/{itemId}/decrement', [CartController::class, 'decrementQuantity'])->name('cart.decrement');
Route::delete('/cart/items/{itemId}', [CartController::class, 'removeItem'])->name('cart.remove-item');

// Checkout routes
Route::prefix('checkout')->name('checkout.')->group(function () {
    Route::get('/', [CheckoutController::class, 'index'])->name('index');
    Route::post('/store', [CheckoutController::class, 'store'])->name('store');
    Route::get('/confirmation', [CheckoutController::class, 'confirmation'])->name('confirmation');
    Route::post('/confirm', [CheckoutController::class, 'confirm'])->name('confirm');
    Route::get('/success/{order}', [CheckoutController::class, 'success'])->name('success');
});

// Wishlist routes
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist');
Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');
Route::delete('/wishlist/remove/{product}', [WishlistController::class, 'remove'])->name('wishlist.remove');
