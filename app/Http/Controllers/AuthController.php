<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use PhpParser\Node\Expr\FuncCall;

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
        }catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }

        return $user;
    }

    public function Login(LoginRequest $request)
    {
        try{
            $credentials = $request->only(['username', 'password']);
            if(JWTAuth::attempt($credentials)) {
                $user = JWTAuth::user();
                $token = JWTAuth::attempt($credentials);

                return response([
                    'message' => 'success',
                    'token' => $token,
                    'token_type' => 'bearer',
                    'expires_in' => JWTAuth::factory()->getTTL(),
                    'user' => $user
                ]);
            }

            return response([
                'message' => 'Incorrect password!'
            ], 400);
        }catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 401);
        }
    }

    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
        } catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $exception) {
            return response(['error' => $exception->getMessage(), 401]);
        }

        return response(['message' => 'Successfully logged out']);
    }

    public function user() {
        try {
            $user = JWTAuth::user();
        } catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $exception) {
            return response(['error' => $exception->getMessage(), 401]);
        }
        return $user;
    }

    public function refresh() {
        try {
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
        } catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $exception) {
            return response(['error' => $exception->getMessage(), 401]);
        }

        return response(['token' => $newToken]);
    }
}
