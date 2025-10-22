<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('guest.product.show');
Route::prefix('cart')->name('guest.cart.')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('index');
    Route::post('add', [CartController::class, 'add'])->name('add');
    Route::post('update', [CartController::class, 'update'])->name('update');
    Route::post('checkout', [CartController::class, 'checkout'])->name('checkout');
});

require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
