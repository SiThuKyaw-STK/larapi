<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ApiAuthController extends Controller
{
    public function register(Request $request){

        $request->validate([
            "name"=>"required|min:3",
            "email"=>"required|unique:users",
            "password"=>"required|min:8|confirmed"
        ]);

        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password)
        ]);

        if (Auth::attempt($request->only(['email','password']))){
            $token = Auth::user()->createToken("phone")->plainTextToken;
            return response()->json($token);
        }
        return response()->json(["message"=>"User not found"],404);
    }
    public function login(){

    }
    public function logout(){

    }
    public function tokens(){

    }
}
