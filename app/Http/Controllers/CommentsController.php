<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comments;

class CommentsController extends Controller
{
    public function index()
    {
        return Comments::all();
    }

    public function store(Request $request)
    {
        return Comments::create($request->all());
    }

    public function show($id)
    {
        return Comments::find($id);
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
}
