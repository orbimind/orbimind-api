<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function show($id)
    {
        return Comments::find($id);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'content' => 'required|string'
        ]);
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
        if (!$data =  DB::table('comments')->where('post_id', $post_id)->get()->toArray()) {
            return response([
                'message' => 'Invalid post or no comments'
            ], 404);
        }

        return $data;
    }

    public function createComment(Request $request, $post_id)
    {
        # code...
    }
}
