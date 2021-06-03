<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoriesResource;
use App\QueryFilters\CategoriesFilter;
use Illuminate\Http\Request;
use App\Models\Categories;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin')->only([
            'store',
            'update',
            'destroy'
        ]);
    }

    public function index(CategoriesFilter $filter)
    {
        $categories = Categories::filter($filter)->get();
        return CategoriesResource::collection($categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:32',
            'description' => 'required|string|max:256'
        ]);

        return Categories::create($request->all());
    }

    public function show(int $category_id)
    {
        if (Categories::find($category_id) === null)
            return response([
                'message' => 'Category does not exist'
            ], 404);

        return Categories::find($category_id);
    }

    public function update(Request $request, int $category_id)
    {
        if (!$data = Categories::find($category_id))
            return response([
                'message' => 'Category does not exist'
            ], 404);
        $data->update($request->all());

        return $data;
    }

    public function destroy(int $category_id)
    {
        if (Categories::find($category_id) === null)
            return response([
                'message' => 'Category does not exist'
            ], 404);

        return Categories::destroy($category_id);
    }

    public function showCategories(int $post_id)
    {
        try {
            if (!$data =  \App\Models\Posts::find($post_id)->category_id)
                return response([
                    'message' => 'Invalid post!'
                ], 404);

            $result = [];
            foreach ($data as $value) {
                if (!$object = Categories::find($value))
                    continue;
                array_push($result, ['value' => $object->id, 'label' =>  $object->title]);
            }

            return response($result);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage()
            ], 401);
        }
    }
}
