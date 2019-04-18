<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RegisterActivate;
use App\Notifications\RegisterActivated;

class AuthController extends Controller
{
    public function register(Request $request){

    	$this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

       $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(60)

        ]);

         $user->notify(new RegisterActivate($user));

        $token = $user->createToken($request->name)->accessToken;
 
        return response()->json(['token' => $token], 201);
       
    }


      /**
     * Confirm your account user (Activate)
     *
     * @param  [type] $token
     * @return [string] message
     * @return [obj] user
     */
    public function registerActivate($token)
    {
        $user = User::where('activation_token', $token)->first();

        if (!$user) {
            return response()->json([
                'message' => __('auth.token_invalid')
            ], 404);
        }

        $user->active = true;
        $user->activation_token = '';
        $user->save();

        $user->notify(new RegisterActivated($user));

        return $user;
    }


     /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'active' => 1
        ];

        
 
        if (auth()->attempt($credentials)) {
            $user = auth()->user();
            $token = $user->createToken($request->email)->accessToken;
            return response()->json([                
                'user' => $user,
                'token_type' => 'Bearer',
                'token' => $token

            ], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
 
    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }


    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }

}

