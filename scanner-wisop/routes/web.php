<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/input', [ProductController::class, 'create'])->name('products.input');
Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/products/{barcode}', [ProductController::class, 'show'])->name('products.show');


Route::get('/products/check/{barcode}', [ProductController::class, 'check'])->name('products.check');
