<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function register(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'name' => 'required|string|min:3',
            'phone' => 'required',
            'password' => 'required|confirmed|min:3|max:100'
        ]);
        return User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "phone" => $validated["phone"],
            "password" => Hash::make($validated["password"])
        ]);
    }
    public function login(Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3|max:100'
        ]);
        if (Auth::attempt($credentials)) {
            $user=Auth::user();
            $token = $user->createToken('twilio-token')->plainTextToken;
            return compact('user','token');
        }
        abort(401);
    }
}
