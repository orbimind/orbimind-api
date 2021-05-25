<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UploadAvatarRequest;
use App\Http\Requests\DownloadAvatarRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Handler;
use App\Models\User;
use App\Models\Posts;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only([
            'index',
            'store',
            'update',
            'destroy',
        ]);
        $this->user = JWTAuth::user(JWTAuth::getToken());
    }

    public function index()
    {
        return User::all();
    }

    public function store(RegisterRequest $request)
    {
        return User::create($request->all());
    }

    public function show(mixed $id)
    {
        if (is_numeric($id)) {
            if (!User::find($id))
                return response([
                    'message' => 'User does not exist'
                ], 404);

            return User::find($id);
        }
        if (!$user = User::where('username', $id)->first())
            return response([
                'message' => 'User does not exist'
            ], 404);

        return $user;
    }

    public function update(UserUpdateRequest $request, int $id)
    {
        if (!$data = User::find($id))
            return response([
                'message' => 'User does not exist'
            ], 404);
        $data->update($request->all());

        return $data;
    }

    public function destroy(int $id)
    {
        if (!User::find($id))
            return response([
                'message' => 'User does not exist'
            ], 404);

        return User::destroy($id);
    }

    public function user()
    {
        try {
            $user = JWTAuth::user(JWTAuth::getToken());
            return response([
                'message' => 'Authenticated as ' . $user->role,
                'token_type' => 'Bearer',
                'expires_in' => JWTAuth::factory()->getTTL() * 60,
                'user' => $user
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response(['error' => $e->getMessage()], 401);
        }
    }

    public function userUpdate(UpdateUserRequest $request)
    {
        try {
            $userID = JWTAuth::user(JWTAuth::getToken())->id;

            /** @var User $user */
            if (!$user = User::find($userID))
                return response([
                    'message' => 'User does not exist!'
                ], 404);

            $user->update($request->only(['username', 'name', 'email', 'password']));
            return response([
                'message' => 'Your profile was updated.',
                'user' =>  $user
            ]);
        } catch (\Exception $e) {
            return response(['error' => $e->getMessage()], 401);
        }
    }

    public function uploadAvatar(UploadAvatarRequest $request)
    {
        if ($request->file('image')) {
            $user = User::find(JWTAuth::user(JWTAuth::getToken())->id);

            $avatarName =  $user->id . $request->file('image')->getClientOriginalName();
            if (\Illuminate\Support\Facades\Storage::disk('s3')->exists('avatars/' . $avatarName))
                \Illuminate\Support\Facades\Storage::disk('s3')->delete('avatars/' . $avatarName);

            $user->update([
                'image' => $image = explode('/', $request->file('image')->storeAs('avatars', $avatarName, 's3'))[1]
            ]);

            return response([
                "message" => "Your avatar was uploaded",
                "image" => $image
            ]);
        }
    }

    public function showMyFaves()
    {
        $user = JWTAuth::user(JWTAuth::getToken());
        if ($user->faves == null)
            return response()->json([
                'message' => 'No favorites here'
            ], 404);

        $result = array();
        foreach ($user->faves as $key) {
            $post = Posts::find($key);
            if (!Handler::authenticatedAsAdmin($this->user)) {
                if ($post->status == true) {
                    array_push($result, $post);
                    continue;
                } else if ($post->status == false && $this->user->id == $post->user_id) {
                    array_push($result, $post);
                    continue;
                } else continue;
            }
            array_push($result, $post);
        }

        return response($result);
    }

    public function showUserFaves(mixed $id)
    {
        $user = $this->show($id);
        if ($user->faves == null)
            return response()->json([
                'message' => 'No favorites here'
            ], 404);

        $result = array();
        foreach ($user->faves as $key) {
            if (!$post = Posts::find($key))
                continue;
            array_push($result, $post);
        }

        return response($result);
    }
}
