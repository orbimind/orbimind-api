<?php

use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::get('/me', 'App\Http\Controllers\AuthController@User')->middleware('auth');
    Route::post('/register', 'App\Http\Controllers\AuthController@Register');
    Route::post('/login', 'App\Http\Controllers\AuthController@Login');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth');
    Route::get('/refresh', 'App\Http\Controllers\AuthController@refresh')->middleware('auth');
    Route::post('/password-reset', 'App\Http\Controllers\PasswordResetsController@ForgotPassword');
    Route::post('/password-reset/{token}', 'App\Http\Controllers\PasswordResetsController@ResetPassword');
});

Route::apiResource('users', 'App\Http\Controllers\UserController')->middleware('auth.admin');
Route::prefix('users')->group(function () {
    Route::post('/avatar', 'App\Http\Controllers\UserController@uploadAvatar')->middleware('auth');
});

Route::apiResource('posts', 'App\Http\Controllers\PostsController');
Route::prefix('posts')->group(function () {
    Route::get('/{post_id}/categories', 'App\Http\Controllers\CategoriesController@showCategories')->middleware('auth');
    Route::get('/{post_id}/comments', 'App\Http\Controllers\CommentsController@showComments')->middleware('auth');
    Route::post('/{post_id}/comments', 'App\Http\Controllers\CommentsController@createComment')->middleware('auth');
    Route::get('/{post_id}/like', 'App\Http\Controllers\LikeController@showPostLikes')->middleware('auth');
    Route::post('/{post_id}/like', 'App\Http\Controllers\LikeController@createPostLike')->middleware('auth');
    Route::delete('/{post_id}/like', 'App\Http\Controllers\LikeController@deletePostLike')->middleware('auth');
});

Route::apiResource('categories', 'App\Http\Controllers\CategoriesController');
Route::prefix('categories')->group(function () {
    Route::get('/{category_id}/posts', 'App\Http\Controllers\PostsController@showPosts')->middleware('auth');
});

Route::apiResource('comments', 'App\Http\Controllers\CommentsController');
Route::prefix('comments')->group(function () {
    Route::get('/{comment_id}/like', 'App\Http\Controllers\LikeController@showCommentLikes')->middleware('auth');
    Route::post('/{comment_id}/like', 'App\Http\Controllers\LikeController@createCommentLike')->middleware('auth');
    Route::delete('/{comment_id}/like', 'App\Http\Controllers\LikeController@deleteCommentLike')->middleware('auth');
});

Route::apiResource('like', 'App\Http\Controllers\LikeController');
