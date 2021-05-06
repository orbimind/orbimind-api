<?php

namespace App\Http\Controllers;

use App\Http\Resources\LikeResource;
use App\Http\Requests\LikeCommentRequest;
use App\Http\Requests\LikePostRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Handler;
use App\Models\Like;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only([
            'index'
        ]);
        $this->user = JWTAuth::user(JWTAuth::getToken());
    }

    public function index()
    {
        return Like::all();
    }

    public function showPostLikes($post_id)
    {
        if (!$data = Like::where('post_id', $post_id)->get())
            return response([
                'message' => 'Invalid post or no likes'
            ], 404);

        if (!Handler::authenticatedAsAdmin($this->user) && \App\Models\Posts::find($post_id)->status == false)
            return response([
                'message' => 'You can not view these likes'
            ], 403);

        return LikeResource::collection($data);
    }

    public function createPostLike(LikePostRequest $request, $post_id)
    {
        try {
            if (!Handler::postExists($post_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);
            if (\App\Models\Posts::find($post_id)->status == false)
                return response([
                    'message' => 'This post is not active'
                ], 403);
            if (Handler::duplicateLikeOnPost($this->user->id, $post_id)) {
                $this->deletePostLike($request, $post_id);
                return response([
                    'message' => $request->input('type') . ' deleted'
                ]);
            }

            $data = [
                'user_id' => $this->user->id,
                'post_id' => $post_id,
                'type' => $request->input('type')
            ];

            return response([
                'message' => $request->input('type') . ' created',
                'data' => Like::create($data)
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deletePostLike(LikePostRequest $request, $post_id)
    {
        try {
            if (!Handler::postExists($post_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);
            if (!$data = Like::where('post_id', $post_id)->where('user_id', $this->user->id)->where('type', $request->input('type'))->first())
                return response()->json([
                    'message' => 'Nothing to remove!'
                ], 404);

            $data->delete();
            return response([
                'message' => $request->input('type') . ' successfuly deleted'
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function showCommentLikes($comment_id)
    {
        if (!$data = Like::where('comment_id', $comment_id)->get())
            return response([
                'message' => 'Invalid comment or no likes'
            ], 404);

        return LikeResource::collection($data);
    }

    public function createCommentLike(LikeCommentRequest $request, $comment_id)
    {
        try {
            if (!Handler::commentExists($comment_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);
            if (Handler::duplicateLikeOnComment($this->user->id, $comment_id)) {
                $this->deleteCommentLike($request, $comment_id);
                return response([
                    'message' => $request->input('type') . ' deleted'
                ]);
            }

            $data = [
                'user_id' => $this->user->id,
                'comment_id' => $comment_id,
                'type' => $request->input('type')
            ];
            return response([
                'message' => $request->input('type') . ' created',
                'data' => Like::create($data)
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deleteCommentLike(LikeCommentRequest $request, $comment_id)
    {
        try {
            if (!Handler::commentExists($comment_id))
                return response()->json([
                    'message' => 'This comment does not exist!'
                ], 404);

            if (!$data = Like::where('comment_id', $comment_id)->where('user_id', $this->user->id)->where('type', $request->input('type'))->first()) {
                return response()->json([
                    'message' => 'Nothing to remove!'
                ], 404);
            }

            $data->delete();
            return response([
                'message' => $request->input('type') . ' successfuly deleted'
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
