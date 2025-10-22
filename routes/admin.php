<?php

use App\Http\Controllers\Admin\AdminProductController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn () => redirect()->route('admin.products.index'))->name('dashboard');
    Route::resource('products', AdminProductController::class)
        ->names('admin.products');
});
