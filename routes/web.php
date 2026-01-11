<?php

use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GlobalDataController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use App\Models\Event;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*=============================================================================================*/
/* start routes */
/*=============================================================================================*/
Route::get('/',function(){
    return view('home');
})->name("home");
// 
Route::get('/event/{id}',function($id){
    $event=Event::where('id',$id)->first();
    return view('view-event')->with('event',$event);
})->name('events.show');
// Route::view('/events/new','new-event')->middleware(['auth','verified'])->name('events.new');
Route::middleware(['auth'])->group(function () {
    Route::get('/events/new',[EventController::class,'create'])->name('events.new');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/inventory',[EventController::class,'viewInventory']);
    Route::delete("/inventory",[EventController::class,'destroy'])->name('events.delete');
});
// 
Route::get('/categories',function(){
    $categories=Category::all();
    return view('categories',compact('categories'));
});
// 
Route::view('/banned','banned-page');
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

Route::put('profile/update', [AuthController::class, 'profileUpdate'])
->name('profile.update')
->middleware('auth');
/*=============================================================================================*/
/* admin routes */
/*=============================================================================================*/
Route::group(["prefix"=>"/admin-panel"],function(){
    Route::view('dashboard',"admin.dashboard-admin");
    Route::get('events',function(){
        $events=Event::all();
        return view("admin.events-admin",compact("events"));
    })->name('admin.events');
    Route::view("reports","admin.reports-admin")->name('admin.reports');
    Route::get('globals',[GlobalDataController::class,"getGlobalData"])->name('admin.globals');
    Route::put('globals',[GlobalDataController::class,"updateGlobalData"])->name('admin.globals.update');
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