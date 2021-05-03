<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function index()
    {
        return Categories::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'description' => 'required|string'
        ]);
        return Categories::create($request->all());
    }

    public function show($category_id)
    {
        return Categories::find($category_id);
    }

    public function update(Request $request, $category_id)
    {
        $data = Categories::find($category_id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($category_id)
    {
        return Categories::destroy($category_id);
    }

    public function showCategories($post_id)
    {
        if (!$data =  DB::table('posts')->where('id', $post_id)->first()->category_id) {
            return response([
                'message' => 'Invalid post!'
            ], 404);
        }

        $result = [];
        $data = json_decode($data);
        foreach ($data as $value) {
            array_push($result, Categories::where('id', $value)->first()->title);
        }

        return response($result);
    }
}
