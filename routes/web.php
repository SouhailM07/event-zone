<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


Route::view('/','home')->name("home");
Route::get('/login', function () {
    return "Cool";
})->name('login');

Route::get('/logout', function () {
    return "You Loged Out";
})->name('logout');

// Register Route
Route::view("/login","login")->name('login');
Route::view("/register","register")->name("register");
Route::post('/login', [AuthController::class, 'handle_login']);
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [AuthController::class, 'profile'])
->name('profile')
->middleware('auth');
