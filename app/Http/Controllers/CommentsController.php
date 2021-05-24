<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Handler;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'update',
            'destroy'
        ]);
        $this->middleware('auth.admin')->only([
            'index',
            'show'
        ]);
        $this->user = JWTAuth::user(JWTAuth::getToken());
    }

    public function index()
    {
        return Comments::all();
    }

    public function show(int $id)
    {
        if (Comments::find($id) === null)
            return response([
                'message' => 'Invalid comment'
            ], 404);

        return Comments::find($id);
    }

    public function update(UpdateCommentRequest $request, int $id)
    {
        if (!$data = Comments::find($id))
            return response([
                'message' => 'Invalid comment'
            ], 404);

        if (!Handler::authenticatedAsAdmin($this->user) && $data->user_id != $this->user->id)
            return response([
                'message' => 'You can not change this comment!'
            ], 403);

        $data->update($request->only(['content']));
        return $data;
    }

    public function destroy(int $id)
    {
        if (!$data = Comments::find($id))
            return response([
                'message' => 'Invalid comment'
            ], 404);

        if (!Handler::authenticatedAsAdmin($this->user) && $data->user_id != $this->user->id)
            return response([
                'message' => 'You can not delete this comment!'
            ], 403);

        return Comments::destroy($id);
    }

    public function showComments(int $post_id)
    {
        if (!Handler::postExists($post_id))
            return response()->json([
                'message' => 'This post does not exist!'
            ], 404);

        if (!$data =  Comments::where('post_id', $post_id)->get()->toArray())
            return response([
                'message' => 'No comments'
            ], 404);

        return $data;
    }

    public function createComment(CreateCommentRequest $request, int $post_id)
    {
        try {
            if (!Handler::postExists($post_id))
                return response()->json([
                    'message' => 'This post does not exist!'
                ], 404);
            if (!Handler::postActive($post_id))
                return response()->json([
                    'message' => 'This post is not active!'
                ], 401);

            $comment = Comments::create([
                'user_id' => $this->user->id,
                'post_id' => $post_id,
                'content' => $request->input('content')
            ]);
            Handler::sendEmailNotifications($comment);

            return $comment;
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }
    }
}
