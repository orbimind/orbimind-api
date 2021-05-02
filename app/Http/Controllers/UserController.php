<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(RegisterRequest $request)
    {
        return User::create($request->all());
    }

    public function uploadAvatar(Request $request)
    {
        return 'User::avatar';
    }

    public function show($id)
    {
        return User::find($id);
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);
        $data->update($request->all());
        return $data;
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }
}
