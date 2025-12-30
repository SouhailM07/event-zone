<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', function () {
    return "Cool";
})->name('login');

Route::get('/logout', function () {
    return "You Loged Out";
})->name('logout');

// Register Route
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [AuthController::class, 'profile'])
->name('profile')
->middleware('auth');

Route::post('profile/update', [AuthController::class, 'updateProfile'])
->name('profile.update')
->middleware('auth');