<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Handler extends Model
{
    static public function authenticatedAsAdmin($user)
    {
        if ($user === null)
            return false;
        else if ($user->role == 'admin')
            return true;
        return false;
    }

    static public function postExists($post_id)
    {
        if (\App\Models\Posts::find($post_id) === null)
            return false;
        return true;
    }
    static public function postActive($post_id)
    {
        return \App\Models\Posts::find($post_id)->status;
    }
    static public function commentExists($comment_id)
    {
        if (\App\Models\Comments::find($comment_id) === null)
            return false;
        return true;
    }
    static public function userExists($user_id)
    {
        if (\App\Models\User::find($user_id) === null)
            return false;
        return true;
    }
    static public function categoryExists($category_id)
    {
        if (\App\Models\Categories::find($category_id) === null)
            return false;
        return true;
    }
    static public function duplicateLikeOnPost($user_id, $post_id)
    {
        if (Like::where('user_id', $user_id)->where('post_id', $post_id)->first() === null)
            return false;
        return true;
    }
    static public function duplicateLikeOnComment($user_id, $comment_id)
    {
        if (Like::where('user_id', $user_id)->where('comment_id', $comment_id)->first() === null)
            return false;
        return true;
    }

    static public function increasePostRating($post_id)
    {
        $current = (int)\App\Models\Posts::where('id', $post_id)->first()->rating;
        $new = $current + 1;
        \App\Models\Posts::where('id', $post_id)->update(array('rating' => $new));

        $user_id = (int)\App\Models\Posts::where('id', $post_id)->first()->user_id;
        Handler::increaseUserRating($user_id);
    }
    static public function decreasePostRating($post_id)
    {
        $current = (int)\App\Models\Posts::where('id', $post_id)->first()->rating;
        $new = $current - 1;
        \App\Models\Posts::where('id', $post_id)->update(array('rating' => $new));

        $user_id = (int)\App\Models\Posts::where('id', $post_id)->first()->user_id;
        Handler::decreaseUserRating($user_id);
    }
    static public function increaseCommentRating($comment_id)
    {
        $current = (int)\App\Models\Comments::where('id', $comment_id)->first()->rating;
        $new = $current + 1;
        \App\Models\Comments::where('id', $comment_id)->update(array('rating' => $new));

        $user_id = (int)\App\Models\Comments::where('id', $comment_id)->first()->user_id;
        Handler::increaseUserRating($user_id);
    }
    static public function decreaseCommentRating($comment_id)
    {
        $current = (int)\App\Models\Comments::where('id', $comment_id)->first()->rating;
        $new = $current - 1;
        \App\Models\Comments::where('id', $comment_id)->update(array('rating' => $new));

        $user_id = (int)\App\Models\Comments::where('id', $comment_id)->first()->user_id;
        Handler::decreaseUserRating($user_id);
    }

    static public function increaseUserRating($user_id)
    {
        $current = (int)\App\Models\User::where('id', $user_id)->first()->rating;
        $new = $current + 1;
        \App\Models\User::where('id', $user_id)->update(array('rating' => $new));
    }
    static public function decreaseUserRating($user_id)
    {
        $current = (int)\App\Models\User::where('id', $user_id)->first()->rating;
        $new = $current - 1;
        \App\Models\User::where('id', $user_id)->update(array('rating' => $new));
    }
}
