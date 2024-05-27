<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [\App\Http\Controllers\Auth\WelcomeController::class, 'index']);

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('users/list', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth')->name('users.list');
Route::delete('users/{user}', [App\Http\Controllers\UserController::class, 'destroy'])->middleware('auth');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->middleware('auth')->name('products.index');
Route::get('/products/create', [App\Http\Controllers\ProductController::class, 'create'])->middleware('auth')->name('products.create');
Route::post('/products', [App\Http\Controllers\ProductController::class, 'store'])->middleware('auth')->name('products.store');
Route::delete('/products/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->middleware('auth');
Route::get('/products/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit'])->middleware('auth')->name('products.edit');
Route::post('/products/{product}', [App\Http\Controllers\ProductController::class, 'update'])->middleware('auth')->name('products.update');
Route::get('/products/{product}', [App\Http\Controllers\ProductController::class, 'show'])->middleware('auth')->name('products.show');
