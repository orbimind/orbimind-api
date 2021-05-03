<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCommentRequest;
use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function show($id)
    {
        return Comments::find($id);
    }

    public function store(CreateCommentRequest $request)
    {
        return Comments::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $data = Comments::find($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
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
        $data = [
            'user_id' => $request->input('user_id'),
            'post_id' => $post_id,
            'content' => $request->input('content')
        ];
        return Comments::create($data);
    }
}
