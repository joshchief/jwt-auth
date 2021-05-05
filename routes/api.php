<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth')->get('/user', function (Request $request) {
    return $request->user();
});

// create user route
Route::get('/user-create', function(Request $request){
    $user = User::create([
        'name' => 'Joshua Nnamani',
        'email' => 'joshchief169@gmail.com',
        'password' => Hash::make("chinaecherem12")
    ]);

    return response()->json([
        'new user' => $user
    ], 201);
});


// login route
Route::post('/login', function(Request $request){

    $credentials = $request->only('email','password');

    if ( ! $token = Auth::attempt($credentials)){
        return response()->json(['error' => 'unauthorized'], 401);
    }
    return $token;
});


// get authenticated user info
Route::middleware('auth')->get('/me', function(){
    return response()->json(Auth::user(), 200);
});

// logout use
Route::get('/getout', function(){
    auth()->logout();
    return response()->json(['message' => 'successfully logged out']);
});