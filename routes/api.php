<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('/me', 'App\Http\Controllers\AuthController@User')->middleware('auth');
    Route::post('/register', 'App\Http\Controllers\AuthController@Register');
    Route::post('/login', 'App\Http\Controllers\AuthController@Login');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout');
    Route::get('/refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('/password-reset', 'App\Http\Controllers\PasswordResetsController@ForgotPassword');
    Route::post('/password-reset/{token}', 'App\Http\Controllers\PasswordResetsController@ResetPassword');
});

Route::apiResource('users', 'App\Http\Controllers\UserController');
Route::prefix('users')->group(function () {
    Route::post('/avatar', 'App\Http\Controllers\UserController@uploadAvatar');
});

Route::apiResource('posts', 'App\Http\Controllers\PostsController');
Route::prefix('posts')->group(function () {
    Route::get('/{post_id}/categories', 'App\Http\Controllers\CategoriesController@showCategories');
    Route::get('/{post_id}/comments', 'App\Http\Controllers\CommentsController@showComments');
    Route::post('/{post_id}/comments', 'App\Http\Controllers\CommentsController@createComment');
    Route::get('/{post_id}/like', 'App\Http\Controllers\LikeController@showPostLikes');
    Route::post('/{post_id}/like', 'App\Http\Controllers\LikeController@createPostLike');
    Route::delete('/{post_id}/like', 'App\Http\Controllers\LikeController@deletePostLike');
});

Route::apiResource('categories', 'App\Http\Controllers\CategoriesController');
Route::prefix('categories')->group(function () {
    Route::get('/{category_id}/posts', 'App\Http\Controllers\PostsController@showPosts');
});

Route::apiResource('comments', 'App\Http\Controllers\CommentsController');
Route::prefix('comments')->group(function () {
    Route::get('/{comment_id}/like', 'App\Http\Controllers\LikeController@showCommentLikes');
    Route::post('/{comment_id}/like', 'App\Http\Controllers\LikeController@createCommentLike');
    Route::delete('/{comment_id}/like', 'App\Http\Controllers\LikeController@deleteCommentLike');
});
