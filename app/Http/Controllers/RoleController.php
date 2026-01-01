<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
        public function changeUserRole(Request $req){
        $userData=$req->only(['userId','roleId']);
        $user=User::find($userData['userId']);
        $user->role_id=$userData['roleId'];
        $user->save();
        return redirect()->back();
    }
}
