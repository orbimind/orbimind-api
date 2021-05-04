<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;
use App\Models\Handler;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function show($id)
    {
        if (Comments::find($id) === null)
            return response([
                'message' => 'Invalid comment'
            ], 404);

        return Comments::find($id);
    }

    public function store(CreateCommentRequest $request)
    {
        return Comments::create($request->all());
    }

    public function update(Request $request, $id)
    {
        if (!$data =  Comments::find($id))
            return response([
                'message' => 'Invalid comment'
            ], 404);
        $data->update($request->all());

        return $data;
    }

    public function destroy($id)
    {
        if (Comments::find($id) === null)
            return response([
                'message' => 'Invalid comment'
            ], 404);

        return Comments::destroy($id);
    }

    public function showComments($post_id)
    {
        if (!$data =  Comments::where('post_id', $post_id)->get()->toArray()) {
            return response([
                'message' => 'Invalid post or no comments'
            ], 404);
        }

        return $data;
    }

    public function createComment(CreateCommentRequest $request, $post_id)
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

            $data = [
                'user_id' => $request->input('user_id'),
                'post_id' => $post_id,
                'content' => $request->input('content')
            ];
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ]);
        }

        return Comments::create($data);
    }
}
