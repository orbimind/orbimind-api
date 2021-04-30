<?php

namespace App\Http\Controllers;

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

    public function show($id)
    {
        return Categories::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = Categories::find($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        return Categories::destroy($id);
    }
}
