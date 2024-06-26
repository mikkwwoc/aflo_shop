<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [\App\Http\Controllers\Auth\WelcomeController::class, 'index']);

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('users/list', [App\Http\Controllers\UserController::class, 'index'])->middleware('superuser')->name('users.list');
Route::delete('users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('superuser');
Route::get('users/edit/{user}', [App\Http\Controllers\UserController::class, 'edit'])->name('users.edit');
Route::post('users/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('users.update');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->middleware('admin')->name('products.index');
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->middleware('admin')->name('products.create');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->middleware('admin')->name('products.store');
Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->middleware('admin');
Route::get('/products/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->middleware('admin')->name('products.edit');
Route::post('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->middleware('admin')->name('products.update');
Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show');

Route::get('/categories', [App\Http\Controllers\ProductCategoryController::class, 'index'])->middleware('admin')->name('categories.index');
Route::get('/categories/create', [App\Http\Controllers\ProductCategoryController::class, 'create'])->middleware('admin')->name('categories.create');
Route::post('/categories', [App\Http\Controllers\ProductCategoryController::class, 'store'])->middleware('admin')->name('categories.store');
Route::delete('/categories/{category}', [App\Http\Controllers\ProductCategoryController::class, 'destroy'])->middleware('admin');
Route::get('/categories/edit/{category}', [App\Http\Controllers\ProductCategoryController::class, 'edit'])->middleware('admin')->name('categories.edit');
Route::post('/categories/{category}', [App\Http\Controllers\ProductCategoryController::class, 'update'])->middleware('admin')->name('categories.update');

Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');
Route::post('cart/{product}', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');
Route::delete('/cart/{product}', [App\Http\Controllers\CartController::class, 'destroy'])->middleware('admin')->name('cart.destroy');

Route::get('/orders', [App\Http\Controllers\OrderController::class, 'index'])->name('orders.index');
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');
Route::get('/orders/{order}', [App\Http\Controllers\OrderController::class, 'edit'])->middleware('admin')->name('orders.edit');
Route::post('/orders/{order}', [App\Http\Controllers\OrderController::class, 'update'])->middleware('admin')->name('orders.update');
Route::get('/orders_user', [App\Http\Controllers\OrderController::class, 'index_user'])->name('orders.indexuser');
