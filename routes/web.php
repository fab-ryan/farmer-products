<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller('LoginController')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});
Route::controller('RegisterController')->group(function () {
    Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('products', [ProductController::class, 'index'])->name('products.index');
    Route::get('products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('products', [ProductController::class, 'storeProduct'])->name('products.store');
    Route::get('products/{product_id}', [ProductController::class, 'update'])->name('products.update');
    Route::put('products/{product_id}', [ProductController::class, 'updateProduct'])->name('products.update');
    Route::delete('products/{product_id}', [ProductController::class, 'destroyProduct'])->name('products.destroy');

    Route::get('categories', [ProductController::class, 'categories'])->name('categories.index');
    Route::post('categories', [ProductController::class, 'storeCategory'])->name('categories.store');
    Route::put('categories/{id}', [ProductController::class, 'updateCategory'])->name('categories.update');
    Route::delete('categories/{id}', [ProductController::class, 'destroyCategory'])->name('categories.destroy');
});
