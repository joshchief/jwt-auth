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
        'name' => 'Cynthia Onwuka',
        'email' => 'chiefezege@gmail.com',
        'password' => Hash::make("chinaecherem12")
    ]);

    return response()->json([
        'new user' => $user
    ], 201);
});


// login route
Route::post('/login', function(){

    $credentials = request()->only(['email', 'password']);

    if ( ! $token = auth('api')->attempt($credentials)){
        return response()->json(['error' => 'unauthorized'], 401);
    }
    return response()->json(['token' => $token,
        'user' => Auth::user()
        ], 201);
});


// get authenticated user info
Route::get('/me', function(){
    $user = Auth::user();
    return $user;
})->middleware('api');


// logout route
Route::post('/logout', function(Request $request){
    Auth::user();
    return response()->json([
        'message' => 'logout successful'
    ]);
});


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
    } */

    /* JWTAuth::invalidate($token);
    auth('api')->logout();
    return response()->json(['message' => 'successfully logged out']); */
    


   /*  Auth::logout(); */
   /* if(! $user = auth()->setRequest($request)->user()) {
       return response()->json(['message' => 'response unauthorized']);
   }
    
    auth()->logout();
    return response()->json(['message' => 'successfully logged out']); */


// public function logout(Request $request) { 
//     if (! $user = auth()->setRequest($request)->user()) { 
//         return $this->responseUnauthorized(); 
//     } 
//     auth()->logout(); 
//     return $this->responseSuccess('Successfully logged out.');     
// }