<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Create a new AuthController instance
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    // manually create user
    public function userCreate()
    {
        $user = User::create([
            'name' => 'Cynthia Onwuka',
            'email' => 'chiefezege@gmail.com',
            'password' => 'chinaecherem12'
        ]);

        return response()->json([
            'user created' => $user
        ], 201);
    }

    // Login function 
    public function login()
    {
        $credentials = request()->only(['email', 'password']);

        if(! $token = Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }
        return response()->json([
            'user' => Auth::user(),
            'token' => $token
        ], 200);
    }

    // get authenticated user info 
    public function me()
    {
        $user = Auth::user();
        return response()->json([
            'user info' => $user
        ]);
    }

    // logout function
    public function logout()
    {
        Auth::logout();
        return response()->json([
            'message' => 'logged out!'
        ]);
    }

    // refresh a token
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    // get token array structure
    public function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
