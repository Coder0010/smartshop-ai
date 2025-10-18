<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('guest.product.show');
Route::get('/cart', [CartController::class, 'index'])->name('guest.cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('guest.cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('guest.cart.update');
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('guest.cart.checkout');

require __DIR__ . '/auth.php';
