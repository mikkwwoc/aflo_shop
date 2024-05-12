<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('users/list', [App\Http\Controllers\UserController::class, 'index'])->middleware('auth')->name('users.list');

Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.all');
