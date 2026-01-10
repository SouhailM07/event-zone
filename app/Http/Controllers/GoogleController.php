<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            // stateless was removed
            $googleUser = Socialite::driver('google')->user();
            $userRole=Role::where("name",'user')->first();
            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
[
        'name' => $googleUser->getName(),
        'oauth' => true,
        'oauth_provider' => 'google',
        'password' => bcrypt(uniqid()), // or null if password is nullable
        'email_verified_at' => now(),
        'role_id' => $userRole->id,                 // choose default role id
        'avatar' => $googleUser->getAvatar(),

    ]
            );

            Auth::login($user);

            return redirect()->intended('/'); // or dashboard
        }catch (\Exception $e) {
    // dd($e->getMessage());
            return redirect()->intended('/'); // or dashboard
}
    }
}
