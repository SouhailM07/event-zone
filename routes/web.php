<?php

use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::view('/','home')->name("home");

// ! login
Route::view("/login","auth.login")->name('login');
Route::post('/login', [AuthController::class, 'handle_login']);
// ! register
Route::post('/register', [AuthController::class, 'register']);
Route::view("/register","auth.register")->name("register");
// ! logout
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/profile', [AuthController::class, 'profile'])
->name('profile')
->middleware('auth');

/*=============================================================================================*/
/* oauth routes */
/*=============================================================================================*/
// ! google
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

/*=============================================================================================*/
/* email verification routes */
/*=============================================================================================*/
// ! 1 
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');
// ! 2
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');
// ! 3
Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


/*=============================================================================================*/
/* password reset routes */
/*=============================================================================================*/
Route::middleware('guest')->group(function () {

Route::get('/forgot-password', [PasswordResetController::class, 'create'])
    ->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'store'])
    ->name('password.email');
Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])
    ->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'update'])
    ->name('password.update');
});
Route::post('profile/update', [AuthController::class, 'updateProfile'])
->name('profile.update')
->middleware('auth');
