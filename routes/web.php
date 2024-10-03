<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('home');
});

// Каталога
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Корзину
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.index');

// Список заказов
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

// Добавить товар в корзину
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');

// Оформить заказ
Route::post('/cart/checkout', [CartController::class, 'checkout'])->name('cart.checkout');

Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
