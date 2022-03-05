<?php

namespace App\Http\Controllers\Oauth2;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('Laravel 8 Oauth2')->accessToken;

        return response()->json( [ 'token' => $token], 200);
    }

    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if( auth()->attempt($credentials) ){
            $token = auth()->user()->createToken('Laravel 8 Oauth2')->accessToken;
            return response()->json(['token'=>$token], 200);
        }else{
            return response()->json( ['error' => 'Unauthenticated'], 401);
        }
    }

    public function refreshToken(){
        if( auth()->check() ){
            $token = auth()->user()->createToken('Laravel 8 Oauth2')->accessToken;
            return response()->json(['token'=>$token], 200);
        }else{
            return response()->json( ['error' => 'Unauthenticated'], 401);
        }
    }
}
