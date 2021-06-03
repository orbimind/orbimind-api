<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class AuthController extends Controller
{
    public function Register(RegisterRequest $request)
    {
        try {
            $user = User::create([
                'username' => $request->input('username'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'image' => 'avatar' . rand(1, 10) . '_orbimind_H265P.png',
                'password' => Hash::make($request->input('password'))
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 400);
        }

        return response([
            'message' => 'User registered. Please log in',
            'user' => $user
        ]);
    }

    public function Login(LoginRequest $request)
    {
        try {
            $credentials = $request->only(['username', 'password']);
            if (JWTAuth::attempt($credentials)) {
                $user = JWTAuth::user();
                $token = JWTAuth::attempt($credentials);

                return response([
                    'message' => 'Logged in',
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'expires_in' => JWTAuth::factory()->getTTL() * 60,
                    'user' => $user
                ]);
            }

            return response([
                'message' => 'Incorrect password!'
            ], 400);
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response([
                'message' => $e->getMessage()
            ], 401);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            return response(['message' => 'Successfully logged out']);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response(['error' => $e->getMessage()], 401);
        }
    }

    public function refresh()
    {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return response(['token' => $newToken]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response(['error' => $e->getMessage()], 401);
        }
    }
}
