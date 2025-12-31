<?php
namespace App\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    //
    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name'     => 'required|string|min:3|unique:users',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password',
        ]);
        $userRole=Role::where("name","user")->first();
        $newUser=User::create($validatedData + [
            "role_id"=>$userRole->id,
        ]);
        // 
        event(new Registered($newUser));
        // 
        Auth::login($newUser);

        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function handle_login(Request $req){
        $validatedData=$req->validate([
            'email'=>"required|email",
            'password'=>"required|min:8"
        ]);
    if(Auth::attempt($validatedData)){
        $req->session()->regenerate();
        return redirect('/');
    }else{
        return back()->withErrors([
            'email'=>"The provided credentials do not match our records."
        ]);
    }}

    public function profileUpdate(Request $request)
    {
        $request->validate([
            'name'  => 'required|string',
            'avatar'=>"nullable|image|max:2048",
        ]);

        $user = auth()->user();
        $userAvatar=$user->avatar;
        if($request->hasFile("avatar")){
            // delete old avatar if exists
            if($user->avatar && Storage::disk('public')->exists($user->avatar)){
                Storage::disk('public')->delete($user->avatar);
            }
            // upload new one
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $userAvatar='storage/'.$avatarPath;
        }
        $user->update([
            'name'  => $request->name,
            'avatar'=> $userAvatar,
        ]);
        // ! search if needed
        // $user->save();
        return redirect()->route('profile')->with('success', 'Account updated successfully');
    }
}
