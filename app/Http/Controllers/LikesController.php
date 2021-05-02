<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Likes;

class LikesController extends Controller
{
    public function index()
    {
        return Likes::all();
    }

    public function showLikes($post_id)
    {
        if (!$data =  DB::table('likes')->where('post_id', $post_id)->get()->toArray()) {
            return response([
                'message' => 'Invalid post or no likes'
            ], 404);
        }

        return $data;
    }

    public function createLike($post_id)
    {
        # code...
    }

    public function deleteLike($post_id)
    {
        # code...
    }
}
