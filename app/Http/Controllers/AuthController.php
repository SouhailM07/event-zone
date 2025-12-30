<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        Auth::login($newUser);

        return redirect('/');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('logout');
    }

    public function profile(){
        $user = Auth::user();
        return view('auth.profile', compact('user'));
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
    }
    }
}
