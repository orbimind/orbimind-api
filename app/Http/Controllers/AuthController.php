<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function Register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'username' => $request->input('username'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]);

            return $user;
        }catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function Login(LoginRequest $request)
    {
        try{
            $credentials = $request->only(['username', 'password']);
            if(Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = Auth::attempt($credentials);

                return response([
                    'message' => 'success',
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => auth()->factory()->getTTL() * 60,
                    'user' => $user
                ]);
            }

            return response([
                'message' => 'Invalid password!'
            ], 400);
        }catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function Logout()
    {
        Auth::logout();
        return response(['message' => 'Successfully logged out']);
    }

    public function user() {
        return Auth::user();
    }

}
