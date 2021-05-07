<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\AvatarRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Avatar;

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
            $user_id = JWTAuth::user(JWTAuth::getToken())->id;

            if ($data = Avatar::where('user_id', $user_id)->first()) {
                \Illuminate\Support\Facades\Storage::delete('public/' . $data->image);
                $data->update([
                    'user_id' => $user_id,
                    'image' => $image = $request->file('image')->storeAs('avatars', $request->file('image')->getClientOriginalName(), 'public')
                ]);

                return response([
                    "message" => "Your avatar was updated",
                    "image" => $image
                ]);
            } else {
                Avatar::create([
                    'user_id' => $user_id,
                    'image' => $image = $request->file('image')->storeAs('avatars', $request->file('image')->getClientOriginalName(), 'public')
                ]);

                return response([
                    "message" => "Your avatar was uploaded",
                    "image" => $image
                ]);
            }
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
