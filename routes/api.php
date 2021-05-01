<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('/me', 'App\Http\Controllers\AuthController@User')->middleware('auth');
    Route::post('/register', 'App\Http\Controllers\AuthController@Register');
    Route::post('/login', 'App\Http\Controllers\AuthController@Login');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('/refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('/password-reset', 'App\Http\Controllers\ForgotPasswordController@ForgotPassword');
    Route::post('/password-reset/{token}', 'App\Http\Controllers\ForgotPasswordController@ResetPassword');
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

