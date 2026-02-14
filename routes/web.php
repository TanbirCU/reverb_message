<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

use App\Http\Controllers\MessageController;

// Public Routes
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login', [HomeController::class, 'login_store'])->name('login-store');

Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register', [HomeController::class, 'register_store'])->name('register-store');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');

    Route::post('/send-message', [MessageController::class, 'send']);
    Route::get('/messages/{user}', [MessageController::class, 'fetch']);
});
