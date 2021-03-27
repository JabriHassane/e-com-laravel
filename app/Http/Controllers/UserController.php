<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $user = User::where(['email'=>$req->email])->first();
        if(!$user || !Hash::check($req->password, $user->password))
        {
            return "User name or password is not matched";
        }
        else{
            $req->session()->put('user',$user);
            return redirect('/');
        }
    }

    public function register(Request $req)
    {
        $user = new User();
        $user->name = $req->username;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->save();
        return redirect('/login');

    }
}
