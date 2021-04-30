<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        User::create([
            'username' => $request->input('username'),
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password'))
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['username', 'password']);

        $token = auth()->attempt($credentials);
        if(!$token) {
            return response()->json(['error' => 'User unauthorized'], 401);
        }

        return $token;
    }

    public function logout(Request $request)
    {

    }

    public function password(Request $request)
    {

    }

    public function passwordtoken(Request $request)
    {

    }
}
