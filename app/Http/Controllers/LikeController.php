<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeCommentRequest;
use \App\Http\Requests\LikePostRequest;
use App\Models\Like;

class LikeController extends Controller
{
    public function showPostLikes($post_id)
    {
        try {
            if (!$data = Like::where('post_id', $post_id)->get()->toArray()) {
                return response([
                    'message' => 'Invalid post or no likes'
                ], 404);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }

        return $data;
    }

    public function createPostLike(LikePostRequest $request, $post_id)
    {
        if (!$this->postExists($post_id))
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);
        if (!$this->userExists($request->input('user_id')))
            return response()->json([
                'message' => 'This user does not exist!'
            ], 404);
        if ($this->duplicateLikeOnPost($request->input('user_id'), $post_id))
            return response()->json([
                'message' => 'You can only give one like!'
            ], 400);

        try {
            $data = [
                'user_id' => $request->input('user_id'),
                'post_id' => $post_id,
                'type' => $request->input('type')
            ];
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }

        return Like::create($data);
    }

    public function deletePostLike(LikePostRequest $request, $post_id)
    {
        if (!$this->postExists($post_id))
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);
        if (!$this->userExists($request->input('user_id')))
            return response()->json([
                'message' => 'This user does not exist!'
            ], 404);

        try {
            $request->validate([
                'user_id' => 'required|integer',
                'type' => 'required|alpha|in:like,dislike'
            ]);
            if (!$data = Like::where('post_id', $post_id)->where('user_id', $request->input('user_id'))->where('type', $request->input('type'))->first()) {
                return response()->json([
                    'message' => 'Nothing to remove!'
                ], 404);
            }
            $data->delete();
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }

        return response([
            'message' => $request->input('type') . ' successfuly deleted'
        ]);
    }

    public function showCommentLikes($comment_id)
    {
        try {
            if (!$data = Like::where('comment_id', $comment_id)->get()->toArray()) {
                return response([
                    'message' => 'Invalid comment or no likes'
                ], 404);
            }
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }

        return $data;
    }

    public function createCommentLike(LikeCommentRequest $request, $comment_id)
    {
        if (!$this->commentExists($comment_id))
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);
        if (!$this->userExists($request->input('user_id')))
            return response()->json([
                'message' => 'This user does not exist!'
            ], 404);
        if ($this->duplicateLikeOnComment($request->input('user_id'), $comment_id))
            return response()->json([
                'message' => 'You can only give one like!'
            ], 400);

        try {
            $data = [
                'user_id' => $request->input('user_id'),
                'comment_id' => $comment_id,
                'type' => $request->input('type')
            ];
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }

        return Like::create($data);
    }

    public function deleteCommentLike(LikeCommentRequest $request, $comment_id)
    {
        if (!$this->commentExists($comment_id))
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);
        if (!$this->userExists($request->input('user_id')))
            return response()->json([
                'message' => 'This user does not exist!'
            ], 404);

        try {
            $request->validate([
                'user_id' => 'required|integer'
            ]);
            if (!$data = Like::where('comment_id', $comment_id)->where('user_id', $request->input('user_id'))->where('type', $request->input('type'))->first()) {
                return response()->json([
                    'message' => 'Nothing to remove!'
                ], 404);
            }
            $data->delete();
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }

        return response([
            'message' => $request->input('type') . ' successfuly deleted'
        ]);
    }

    protected function postExists($post_id)
    {
        if (\App\Models\Posts::find($post_id) === null)
            return false;
        return true;
    }
    protected function commentExists($comment_id)
    {
        if (\App\Models\Comments::find($comment_id) === null)
            return false;
        return true;
    }
    protected function userExists($user_id)
    {
        if (\App\Models\User::find($user_id) === null)
            return false;
        return true;
    }
    protected function duplicateLikeOnPost($user_id, $post_id)
    {
        if (Like::where('user_id', $user_id)->where('post_id', $post_id)->first() === null)
            return false;
        return true;
    }
    protected function duplicateLikeOnComment($user_id, $comment_id)
    {
        if (Like::where('user_id', $user_id)->where('comment_id', $comment_id)->first() === null)
            return false;
        return true;
    }
}
