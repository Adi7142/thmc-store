<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Store\CatalogController;
use App\Http\Controllers\Store\CartController;
use App\Http\Controllers\Store\CheckoutController;
use App\Http\Controllers\Store\OrderController;
use App\Http\Controllers\Payments\StripeWebhookController;

// ⭐ Homepage → store
Route::redirect('/', '/store');

// Stripe webhook (public, no auth)
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])->name('stripe.webhook');

// Store (public browsing)
Route::get('/store', [CatalogController::class, 'index'])->name('store.index');
Route::get('/store/coins', [CatalogController::class, 'coins'])->name('store.coins');
Route::get('/store/bundles', [CatalogController::class, 'bundles'])->name('store.bundles');
Route::get('/store/ranks', [CatalogController::class, 'ranks'])->name('store.ranks');
Route::get('/store/keys', [CatalogController::class, 'keys'])->name('store.keys');

// Cart (public)
Route::get('/cart', [CartController::class, 'show'])->name('cart.show');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');

// Auth-required pages
Route::middleware('auth')->group(function () {
    // Breeze profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Checkout + orders
    Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'createOrder'])->name('checkout.create');
    Route::post('/checkout/pay/{order}', [CheckoutController::class, 'pay'])->name('checkout.pay');

    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
});

require __DIR__.'/auth.php';
