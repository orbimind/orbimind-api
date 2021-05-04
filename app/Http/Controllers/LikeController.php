<?php

namespace App\Http\Controllers;

use App\Http\Requests\LikeCommentRequest;
use \App\Http\Requests\LikePostRequest;
use App\Models\Handler;
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
        try {
            if (!Handler::postExists($post_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);
            if (!Handler::userExists($request->input('user_id')))
                return response()->json([
                    'message' => 'This user does not exist!'
                ], 404);
            if (Handler::duplicateLikeOnPost($request->input('user_id'), $post_id)) {
                $this->deletePostLike($request, $post_id);
                return response([
                    'message' => $request->input('type') . ' deleted'
                ]);
            }

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

        return response([
            'message' => $request->input('type') . ' created',
            'data' => Like::create($data)
        ]);
    }

    public function deletePostLike(LikePostRequest $request, $post_id)
    {
        try {
            if (!Handler::postExists($post_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);
            if (!Handler::userExists($request->input('user_id')))
                return response()->json([
                    'message' => 'This user does not exist!'
                ], 404);

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
        try {
            if (!$this->commentExists($comment_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);
            if (!Handler::userExists($request->input('user_id')))
                return response()->json([
                    'message' => 'This user does not exist!'
                ], 404);
            if (Handler::duplicateLikeOnComment($request->input('user_id'), $comment_id)) {
                $this->deleteCommentLike($request, $comment_id);
                return response([
                    'message' => $request->input('type') . ' deleted'
                ]);
            }

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

        return response([
            'message' => $request->input('type') . ' created',
            'data' => Like::create($data)
        ]);
    }

    public function deleteCommentLike(LikeCommentRequest $request, $comment_id)
    {
        try {
            if (!$this->commentExists($comment_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);
            if (!Handler::userExists($request->input('user_id')))
                return response()->json([
                    'message' => 'This user does not exist!'
                ], 404);

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
}
