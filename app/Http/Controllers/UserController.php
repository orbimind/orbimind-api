<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\AvatarRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(RegisterRequest $request)
    {
        return User::create($request->all());
    }

    public function uploadAvatar(AvatarRequest $request)
    {
        if ($request->file('image')) {
            $user = User::find(JWTAuth::user(JWTAuth::getToken())->id);
            if ($user->image != 'avatars/default.jpeg')
                \Illuminate\Support\Facades\Storage::delete('public/' . $user->image);
            $user->update([
                'image' => $image = $request->file('image')->storeAs('avatars', $user->id . $request->file('image')->getClientOriginalName(), 'public')
            ]);

            return response([
                "message" => "Your avatar was uploaded",
                "image" => $image
            ]);
        }
    }

    public function show($id)
    {
        if (User::find($id) === null)
            return response([
                'message' => 'User does not exist'
            ], 404);

        return User::find($id);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        if (!$data = User::find($id))
            return response([
                'message' => 'User does not exist'
            ], 404);
        $data->update($request->all());

        return $data;
    }

    public function destroy($id)
    {
        if (User::find($id) === null)
            return response([
                'message' => 'User does not exist'
            ], 404);

        return User::destroy($id);
    }
}
