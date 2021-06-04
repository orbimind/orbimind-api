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

    public function showPostLikes(int $post_id)
    {
        if (!Handler::postExists($post_id))
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);

        if (!$data = Like::where('post_id', $post_id)->get()->all())
            return response([
                'message' => 'No likes'
            ]);

        return LikeResource::collection($data);
    }

    public function createPostLike(LikePostRequest $request, int $post_id)
    {
        try {
            if (!Handler::postExists($post_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);

            $phase = ' created';
            if (Handler::duplicateLikeOnPost($this->user->id, $post_id)) {
                if ($request->input('type') == 'like' && Like::where('user_id', $this->user->id)->where('post_id', $post_id)->where('type', 'like')->first() === null) {
                    $request->merge(['type' => 'dislike']);
                    $this->deletePostLike($request, $post_id);
                    $request->merge(['type' => 'like']);
                    $phase = ' switched';
                } else if ($request->input('type') == 'dislike' && Like::where('user_id', $this->user->id)->where('post_id', $post_id)->where('type', 'dislike')->first() === null) {
                    $request->merge(['type' => 'like']);
                    $this->deletePostLike($request, $post_id);
                    $request->merge(['type' => 'dislike']);
                    $phase = ' switched';
                } else
                    return $this->deletePostLike($request, $post_id);
            }

            $data = [
                'user_id' => $this->user->id,
                'post_id' => $post_id,
                'type' => $request->input('type')
            ];

            if ($request->input('type') == 'like')
                Handler::increasePostRating($post_id);
            else
                Handler::decreasePostRating($post_id);

            return response([
                'message' => $request->input('type') . $phase,
                'data' => Like::create($data)
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deletePostLike(LikePostRequest $request, int $post_id)
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

            if (Like::where('post_id', $post_id)->first()->type == 'like')
                Handler::decreasePostRating($post_id);
            else
                Handler::increasePostRating($post_id);

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

    public function showCommentLikes(int $comment_id)
    {
        if (!$data = Like::where('comment_id', $comment_id)->get()->all())
            return response([
                'message' => 'Invalid comment or no likes'
            ]);

        return LikeResource::collection($data);
    }

    public function createCommentLike(LikeCommentRequest $request, int $comment_id)
    {
        try {
            if (!Handler::commentExists($comment_id))
                return response()->json([
                    'message' => 'This comment does not exist!'
                ], 404);

            $phase = ' created';
            if (Handler::duplicateLikeOnComment($this->user->id, $comment_id)) {
                if ($request->input('type') == 'like' && Like::where('user_id', $this->user->id)->where('comment_id', $comment_id)->where('type', 'like')->first() === null) {
                    $request->merge(['type' => 'dislike']);
                    $this->deleteCommentLike($request, $comment_id);
                    $request->merge(['type' => 'like']);
                    $phase = ' switched';
                } else if ($request->input('type') == 'dislike' && Like::where('user_id', $this->user->id)->where('comment_id', $comment_id)->where('type', 'dislike')->first() === null) {
                    $request->merge(['type' => 'like']);
                    $this->deleteCommentLike($request, $comment_id);
                    $request->merge(['type' => 'dislike']);
                    $phase = ' switched';
                } else
                    return $this->deleteCommentLike($request, $comment_id);
            }

            $data = [
                'user_id' => $this->user->id,
                'comment_id' => $comment_id,
                'type' => $request->input('type')
            ];

            if ($request->input('type') == 'like')
                Handler::increaseCommentRating($comment_id);
            else
                Handler::decreaseCommentRating($comment_id);

            return response([
                'message' => $request->input('type') . $phase,
                'data' => Like::create($data)
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function deleteCommentLike(LikeCommentRequest $request, int $comment_id)
    {
        try {
            if (!Handler::commentExists($comment_id))
                return response()->json([
                    'message' => 'This comment does not exist!'
                ], 404);

            if (!$data = Like::where('comment_id', $comment_id)->where('user_id', $this->user->id)->where('type', $request->input('type'))->first())
                return response()->json([
                    'message' => 'Nothing to remove!'
                ], 404);

            if (Like::where('comment_id', $comment_id)->first()->type == 'like')
                Handler::decreaseCommentRating($comment_id);
            else
                Handler::increaseCommentRating($comment_id);

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
