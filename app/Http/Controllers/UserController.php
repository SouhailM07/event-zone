<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getUsers(){
        $users = User::paginate(12);
        $roles=Role::all();
        return view("admin.users-admin",["users"=>$users,"roles"=>$roles]);
    }

    public function changeUserRole(Request $req){
        $userData=$req->only(['userId','roleId']);
        $user=User::find($userData['userId']);
        $user->role_id=$userData['roleId'];
        $user->save();
        return redirect()->back();
    }
    public function toggleVerifyUser(Request $req){
        $userId=$req->input('userId');
        $user=User::find($userId);
        $userVerified= $user->account_verified;
        $user->account_verified = ! $userVerified;
        $user->save();
        return redirect()->back()->with('status','User verification status updated successfully.');
    }

    public function toggleBanUser(Request $req){
        $userId=$req->input('userId');
        $user=User::find($userId);
        $isBanned= $user->is_banned;
        $user->is_banned= ! $isBanned;
        $user->save();
        return redirect()->back()->with('status','User ban status updated successfully.');
    }

    public function deleteUser(Request $req){
        $userId=$req->input('userId');
        $user=User::find($userId);
        if($user->role->name=='owner'&& auth()->user()->role!=='owner'){
            return redirect()->back()->withErrors(['msg'=>'You cannot delete an owner account.']);
        }
        if($user->avatar && $user->avatar!='/images/default-avatar.png'){
            $avatarPath=public_path($user->avatar);
            if(file_exists($avatarPath)){
                unlink($avatarPath);
            }
        }
        $user->delete();
        return redirect()->route('admin.users')->with('status','User deleted successfully.');
    }
}
