<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::group([], function () {
    /** Authentication Routes */
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'logMeIn'])->name('logMeIn');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerMe'])->name('registerMe');

    /** Authenticated Routes */
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

        Route::resource('stores', StoreController::class);
        Route::resource('stocks', StockController::class);
        Route::post('stock_history', [StockController::class, 'addHistory'])->name('addHistory');
        Route::post('stock_history/{id}', [StockController::class, 'removeHistory'])->name('removeHistory');
    });
});
