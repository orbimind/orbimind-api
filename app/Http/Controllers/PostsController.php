<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostsResource;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Posts;
use App\QueryFilters\PostsFilter;
use App\Models\Handler;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'store',
            'update',
            'destroy'
        ]);
        $this->user = JWTAuth::user(JWTAuth::getToken());
    }

    public function index(PostsFilter $filter)
    {
        $posts = Posts::filter($filter)->get();

        return PostsResource::collection($posts);
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

    public function show(int $id)
    {
        if (!Handler::postExists($id)) {
            return response([
                'message' => 'Invalid post'
            ], 404);
        }
        $data = Posts::find($id);

        return $data;
    }

    public function update(UpdatePostRequest $request, int $id)
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

        $data->update($request->all());
        return $data;
    }

    public function destroy(int $id)
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

    public function showPosts(int $category_id)
    {
        if (!Handler::categoryExists($category_id))
            return response([
                'message' => 'Invalid category!'
            ], 404);

        return Posts::whereJsonContains('category_id', $category_id)->get();
    }

    public function addToFaves(int $post_id)
    {
        if (!Posts::find($post_id))
            return response([
                'message' => 'This post does not exist'
            ], 404);

        $faves = $this->user->faves;
        if ($faves == null) {
            $faves = array();
            array_push($faves, $post_id);
            \App\Models\User::find($this->user->id)->update(['faves' => $faves]);
            return response([
                'message' => 'Post successfully added to favorites'
            ]);
        }

        foreach ($faves as $key)
            if ($key == $post_id)
                return $this->removeFromFaves($post_id);

        array_push($faves, $post_id);
        \App\Models\User::find($this->user->id)->update(['faves' => $faves]);

        return response([
            'message' => 'Post successfully added to favorites'
        ]);
    }

    public function removeFromFaves(int $post_id)
    {
        if (!Posts::find($post_id))
            return response([
                'message' => 'This post does not exist'
            ], 404);

        if (!$faves = $this->user->faves)
            return response([
                'message' => 'Nothing to remove'
            ], 404);

        $result = array();
        foreach ($faves as $key) {
            if ($key == $post_id)
                continue;
            array_push($result, (int)$key);
        }
        if ($result == [])
            $result = null;

        \App\Models\User::find($this->user->id)->update(['faves' => $result]);

        return response([
            'message' => 'Post successfully deleted from favorites'
        ]);
    }
}
