<?php

use Illuminate\Support\Facades\Route;

/**
 * Authorization module
 */
Route::prefix('auth')->group(function () {
    Route::post('/register', 'App\Http\Controllers\AuthController@Register');
    Route::post('/login', 'App\Http\Controllers\AuthController@Login');
    Route::post('/logout', 'App\Http\Controllers\AuthController@logout')->middleware('auth');
    Route::get('/refresh', 'App\Http\Controllers\AuthController@refresh')->middleware('auth');
    Route::post('/password-reset', 'App\Http\Controllers\PasswordResetsController@ForgotPassword');
    Route::post('/password-reset/{token}', 'App\Http\Controllers\PasswordResetsController@ResetPassword');
    Route::get('/password-reset/{token}/remove', 'App\Http\Controllers\PasswordResetsController@RemoveRequestPassword');
});


/**
 * User control module
 */
Route::prefix('users')->middleware('auth')->group(function () {
    Route::get('/me', 'App\Http\Controllers\UserController@user');
    Route::post('/me/update', 'App\Http\Controllers\UserController@userUpdate');
    Route::get('/me/favorites', 'App\Http\Controllers\UserController@showMyFaves');
    Route::post('/avatar', 'App\Http\Controllers\UserController@uploadAvatar');
});
Route::get('/users/{user_id}/favorites', 'App\Http\Controllers\UserController@showUserFaves');
Route::apiResource('users', 'App\Http\Controllers\UserController');


/**
 * Posts control module
 */
Route::prefix('posts')->group(function () {
    Route::get('/{post_id}/categories', 'App\Http\Controllers\CategoriesController@showCategories');
    Route::get('/{post_id}/comments', 'App\Http\Controllers\CommentsController@showComments');
    Route::get('/{post_id}/like', 'App\Http\Controllers\LikeController@showPostLikes');
});
Route::prefix('posts')->middleware('auth')->group(function () {
    Route::post('/{post_id}/comments', 'App\Http\Controllers\CommentsController@createComment');
    Route::post('/{post_id}/like', 'App\Http\Controllers\LikeController@createPostLike');
    Route::delete('/{post_id}/like', 'App\Http\Controllers\LikeController@deletePostLike');
    Route::post('/{post_id}/favorite', 'App\Http\Controllers\PostsController@addToFaves');
    Route::delete('/{post_id}/favorite', 'App\Http\Controllers\PostsController@removeFromFaves');
    Route::post('/{post_id}/subscribe', 'App\Http\Controllers\SubscriptionController@createSubscription');
    Route::delete('/{post_id}/subscribe', 'App\Http\Controllers\SubscriptionController@removeSubscription');
});
Route::apiResource('posts', 'App\Http\Controllers\PostsController');


/**
 * Category control module
 */
Route::prefix('categories')->group(function () {
    Route::get('/{category_id}/posts', 'App\Http\Controllers\PostsController@showPosts');
});
Route::apiResource('categories', 'App\Http\Controllers\CategoriesController');


/**
 * Comment control module
 */
Route::prefix('comments')->group(function () {
    Route::get('/{comment_id}/like', 'App\Http\Controllers\LikeController@showCommentLikes');
});
Route::prefix('comments')->middleware('auth')->group(function () {
    Route::get('/{comment_id}/best', 'App\Http\Controllers\CommentsController@setBestComment');
    Route::post('/{comment_id}/like', 'App\Http\Controllers\LikeController@createCommentLike');
    Route::delete('/{comment_id}/like', 'App\Http\Controllers\LikeController@deleteCommentLike');
});
Route::apiResource('comments', 'App\Http\Controllers\CommentsController');


/**
 * Like control module
 */
Route::apiResource('like', 'App\Http\Controllers\LikeController');
