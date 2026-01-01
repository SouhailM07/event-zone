<?php

use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

Route::view('/','home')->name("home");
Route::view('/events/new','new-event')->middleware(['auth','verified'])->name('events.new');

// ! login
Route::view("/login","auth.login")->name('login');
Route::post('/login', [AuthController::class, 'handle_login']);
// ! register
Route::post('/register', [AuthController::class, 'register']);
Route::view("/register","auth.register")->name("register");
// ! logout
Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::view('/profile', "user-profile")
->name('profile')
->middleware('auth');

/*=============================================================================================*/
/* admin routes */
/*=============================================================================================*/
Route::group(["prefix"=>"/admin-panel"],function(){
    Route::view('dashboard',"admin.dashboard-admin");
    Route::get('users',[UserController::class,'getUsers'])->name('admin.users');
    Route::put('verify-user',[UserController::class,'toggleVerifyUser'])->name('verify.user');
    Route::put('ban-user',[UserController::class,'toggleBanUser'])->name('ban.user');
    Route::put('change-user-role',[RoleController::class,'changeUserRole'])->name('change.user.role');
    Route::delete('delete-user',[UserController::class,'deleteUser'])->name('delete.user');
});
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
Route::put('profile/update', [AuthController::class, 'profileUpdate'])
->name('profile.update')
->middleware('auth');
