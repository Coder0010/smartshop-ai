<?php

use App\Http\Controllers\Admin\AdminProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('admin.products.index'))->name('dashboard');
    Route::resource('products', AdminProductController::class)->names('admin.products');
});

require __DIR__ . '/auth.php';
