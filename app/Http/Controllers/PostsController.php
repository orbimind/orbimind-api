<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class PostsController extends Controller
{
    public function index()
    {
        return Posts::all();
    }

    public function store(Request $request)
    {
        return Posts::create($request->all());
    }

    public function show($id)
    {
        return Posts::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = Posts::find($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        return Posts::destroy($id);
    }
}
