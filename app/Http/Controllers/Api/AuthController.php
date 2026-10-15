<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6'
        ],[
            'required' => 'Data harus diisi',
            'string' => 'Data harus dalam bentuk text',
            'email.unique'=> 'Email sudah terpakai',
            'email.email' => 'Email harus valid!',
            'password.min' => "Password minimal 6 karakter."
        ]);

        $user = User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        $token = JWTAuth::fromUser($user);
        return response()->json([
            'token' => $token,
            'data' => $user
        ], 201); 
    }

    public function login(Request $request){
        $request->validate([
            'email'=> 'required|string|email',
            'password'=> 'required|string'
        ]);

        $user = User::where('email', $request->email)->first();
        $token = JWTAuth::attempt($request->only('email','password'));
        if(!$token){
            return response()->json([
                'error' => 'Email atau Password salah!'
            ], 401);
        }
        
        return response()->json([
            'token' => $token,
            'data' => $user
        ], 200);
    }

    public function logout(){
        JWTAuth::parseToken()->invalidate();
        return response()->json(['message' => 'Berhasil logout']);
    }
}
