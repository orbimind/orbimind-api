<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreatePostRequest;
use App\Models\Posts;
use App\Models\Handler;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only([
            'index',
            'store',
            'show',
            'update',
            'destroy'
        ]);
    }

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
        if (!Handler::postExists($id))
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
        if (!Handler::postExists($id))
            return response([
                'message' => 'Invalid post'
            ], 404);

        return Posts::destroy($id);
    }

    public function showPosts($category_id)
    {
        if (!Handler::categoryExists($category_id))
            return response([
                'message' => 'Invalid category!'
            ], 404);

        return Posts::whereJsonContains('category_id', (int)$category_id)->get();
    }
}
