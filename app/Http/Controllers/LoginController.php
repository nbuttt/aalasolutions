<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
        'remember_me' => 'boolean'
        ]);
    
        $credentials = request(['email','password']);
        if(!Auth::attempt($credentials))
        {
        return response()->json([
            'message' => 'Unauthorized'
        ],401);
        }
    
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;
    
        return response()->json([
        'accessToken' =>$token,
        'token_type' => 'Bearer',
        ]);
    }
}
