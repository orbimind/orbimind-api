<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Http\Requests\CreatePostRequest;

class PostsController extends Controller
{
    public function index()
    {
        return Posts::all();
    }

    public function store(CreatePostRequest $request)
    {
        return Posts::create($request->all());
    }

    public function show($id)
    {
        if (Posts::find($id) === null)
            return response([
                'message' => 'Invalid post'
            ], 404);

        return Posts::find($id);
    }

    public function update(Request $request, $id)
    {
        if (!$data = Posts::find($id))
            return response([
                'message' => 'Invalid post'
            ], 404);
        $data->update($request->all());

        return $data;
    }

    public function destroy($id)
    {
        if (Posts::find($id) === null)
            return response([
                'message' => 'Invalid post'
            ], 404);

        return Posts::destroy($id);
    }

    public function showPosts($category_id)
    {
        if (!$data =  Posts::where('category_id', $category_id)->get()->toArray()) {
            return response([
                'message' => 'Invalid category!'
            ], 404);
        }

        return $data;
    }
}
