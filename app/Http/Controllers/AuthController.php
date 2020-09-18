<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function register(Request $request){
        return User::create([
            "name" => $request->name,
            "email" => $request->email,
            "phone" => $request->phone,
            "password" => Hash::make($request->password)
        ]);
    }
    public function login(Request $request){
        $credentials = $request->only('email', 'password'); 
        if (Auth::attempt($credentials)) {
            $user=Auth::user();
            $token = $user->createToken('twilio-token')->plainTextToken;
            return compact('user','token');
        }
    }
}
