<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
    }

    public function login(){
        $credentials = request(['name', 'password']);

        if ($token = auth()->attempt($credentials)) {
            return response()->json(['status' => 'success', 'token'=>$token]);
        }

        return response()->json(['status' => 'error']);
    }
}
