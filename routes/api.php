<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->get("/auth/me", function () {
    return auth()->user();
});

Route::prefix('auth')->group(function () {
    Route::post('/register', 'App\Http\Controllers\AuthController@register');
    Route::post('/login', 'App\Http\Controllers\AuthController@login');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('/password-reset', 'App\Http\Controllers\AuthController@password');
    Route::post('/password-reset/{token}', 'App\Http\Controllers\AuthController@passwordtoken');
});

// Users Entity
Route::apiResource('users', 'App\Http\Controllers\UserController');
Route::post('users/avatar', 'App\Http\Controllers\UserController@uploadAvatar');

// Posts Entity
Route::apiResource('posts', 'App\Http\Controllers\PostsController');

// Categories Entity
Route::apiResource('categories', 'App\Http\Controllers\CategoriesController');

// Comments Entity
Route::apiResource('comments', 'App\Http\Controllers\CommentsController');

