<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Auth;

class UserController extends Controller
{
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|min:3',
            'password' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors'=>$validator->errors()]);
        }

        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->save();
        return response()->json(['status'=>'success','data'=>$user]);
    }

    public function login(){
        $credentials = request(['name', 'password']);

        if ($token = auth::guard('api')->attempt($credentials)) {
            return response()->json(['status' => 'success', 'token'=>$token]);
        }

        return response()->json(['status' => 'error']);
    }

    public function logout(){
        auth::logout();
    }
}
