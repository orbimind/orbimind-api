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

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'post_id' => 'required|integer',
            'content' => 'required|string'
        ]);
        return Likes::create($request->all());
    }

    public function show($id)
    {
        return Likes::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = Likes::find($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        return Likes::destroy($id);
    }
}
