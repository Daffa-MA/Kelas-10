<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

// Rute untuk manajemen kategori
Route::resource('categories', CategoryController::class);

// Rute untuk manajemen menu
Route::resource('menus', MenuController::class);

// Rute untuk manajemen pesanan
Route::resource('orders', OrderController::class);

// Rute untuk keranjang belanja
use App\Http\Controllers\CartController;

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
