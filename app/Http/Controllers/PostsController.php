<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Posts;
use App\Models\Handler;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'index',
            'store',
            'show',
            'update',
            'destroy'
        ]);
        $this->user = JWTAuth::user(JWTAuth::getToken());
    }

    public function index()
    {
        if (!Handler::authenticatedAsAdmin($this->user)) {
            $data = Posts::all()->where('user_id', $this->user->id)->where('status', false);
            return $data->merge(Posts::all()->where('status', true));
        } else
            return Posts::all();
    }

    public function store(CreatePostRequest $request)
    {
        try {
            $data = [
                'user_id' => $this->user->id,
                'title' => $request->input('title'),
                'content' => $request->input('content'),
                'category_id' => $request->input('category_id')
            ];

            return Posts::create($data);
        } catch (\Illuminate\Database\QueryException $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id)
    {
        if (!Handler::postExists($id)) {
            return response([
                'message' => 'Invalid post'
            ], 404);
        } else
            $data = Posts::find($id);

        if (!Handler::authenticatedAsAdmin($this->user)) {
            if ($data->status == false && $data->user_id != $this->user->id)
                return response([
                    'message' => 'You can not view this post!'
                ], 403);
        } else
            return $data;
    }

    public function update(UpdatePostRequest $request, $id)
    {
        if (!$data = Posts::find($id))
            return response([
                'message' => 'Invalid post'
            ], 404);

        if (!Handler::authenticatedAsAdmin($this->user)) {
            if ($data->user_id != $this->user->id)
                return response([
                    'message' => 'You can not edit this post!'
                ], 403);
        }

        $data->update($request->only(['title', 'content', 'category_id', 'status']));
        return $data;
    }

    public function destroy($id)
    {
        if (!Handler::postExists($id))
            return response([
                'message' => 'Invalid post'
            ], 404);

        $data = Posts::find($id);
        if (!Handler::authenticatedAsAdmin($this->user)) {
            if ($data->user_id != $this->user->id)
                return response([
                    'message' => 'You can not delete this post!'
                ], 403);
        }

        return Posts::destroy($id);
    }

    public function showPosts($category_id)
    {
        if (!Handler::categoryExists($category_id))
            return response([
                'message' => 'Invalid category!'
            ], 404);

        if (!Handler::authenticatedAsAdmin($this->user)) {
            $data = Posts::whereJsonContains('category_id', (int)$category_id)->get()->where('user_id', $this->user->id)->where('status', false);
            return $data->merge(Posts::whereJsonContains('category_id', (int)$category_id)->get()->where('status', true));
        } else {
            return Posts::whereJsonContains('category_id', (int)$category_id)->get();
        }
    }
}
