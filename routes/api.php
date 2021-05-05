<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AuthController;


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

// Route::middleware('auth')->get('/user', function (Request $request) {
//     return $request->user();
// });

// create user route
// Route::get('/user-create', function(Request $request){
//     $user = User::create([
//         'name' => 'Joshua Nnamani',
//         'email' => 'joshchief169@gmail.com',
//         'password' => Hash::make("chinaecherem12")
//     ]);

//     return response()->json([
//         'new user' => $user
//     ], 201);
// });

Route::group([
    'middleware' => 'auth',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'auth'
], function(){
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});


// login route
// Route::post('/login', function(Request $request){

//     $credentials = $request->only('email','password');

//     if ( ! $token = Auth::attempt($credentials)){
//         return response()->json(['error' => 'unauthorized'], 401);
//     }
//     return $token;
// });


// get authenticated user info
// Route::middleware('auth')->get('/me', function(){
//     return response()->json(Auth::user(), 200);
// });

// logout use
// Route::post('/logout', function(Request $request){

//     $this->guard()->logout();

   /*  $token = $request->header('Authorization');

    try {

        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out'
        ]);

    } catch (TokenExpiredException $e){

        return response()->json([
            'status' => 'success',
            'message' => 'Failed Logout, please try again'
        ], 500);
    }

    /* JWTAuth::invalidate($token);
    auth('api')->logout();
    return response()->json(['message' => 'successfully logged out']); */
    


   /*  Auth::logout(); */
   /* if(! $user = auth()->setRequest($request)->user()) {
       return response()->json(['message' => 'response unauthorized']);
   }
    
    auth()->logout();
    return response()->json(['message' => 'successfully logged out']); */
// });

// public function logout(Request $request) { 
//     if (! $user = auth()->setRequest($request)->user()) { 
//         return $this->responseUnauthorized(); 
//     } 
//     auth()->logout(); 
//     return $this->responseSuccess('Successfully logged out.');     
// } */