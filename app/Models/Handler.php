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
        if (Posts::find($post_id) === null)
            return false;
        return true;
    }
    static public function postActive($post_id)
    {
        return Posts::find($post_id)->status;
    }
    static public function commentExists($comment_id)
    {
        if (Comments::find($comment_id) === null)
            return false;
        return true;
    }
    static public function userExists($user_id)
    {
        if (User::find($user_id) === null)
            return false;
        return true;
    }
    static public function categoryExists($category_id)
    {
        if (Categories::find($category_id) === null)
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
        $current = (int)Posts::where('id', $post_id)->first()->rating;
        $new = $current + 1;
        Posts::where('id', $post_id)->update(array('rating' => $new));

        $user_id = (int)Posts::where('id', $post_id)->first()->user_id;
        Handler::increaseUserRating($user_id);
    }
    static public function decreasePostRating($post_id)
    {
        $current = (int)Posts::where('id', $post_id)->first()->rating;
        $new = $current - 1;
        Posts::where('id', $post_id)->update(array('rating' => $new));

        $user_id = (int)Posts::where('id', $post_id)->first()->user_id;
        Handler::decreaseUserRating($user_id);
    }
    static public function increaseCommentRating($comment_id)
    {
        $current = (int)Comments::where('id', $comment_id)->first()->rating;
        $new = $current + 1;
        Comments::where('id', $comment_id)->update(array('rating' => $new));

        $user_id = (int)Comments::where('id', $comment_id)->first()->user_id;
        Handler::increaseUserRating($user_id);
    }
    static public function decreaseCommentRating($comment_id)
    {
        $current = (int)Comments::where('id', $comment_id)->first()->rating;
        $new = $current - 1;
        Comments::where('id', $comment_id)->update(array('rating' => $new));

        $user_id = (int)Comments::where('id', $comment_id)->first()->user_id;
        Handler::decreaseUserRating($user_id);
    }

    static public function increaseUserRating($user_id)
    {
        $current = (int)User::where('id', $user_id)->first()->rating;
        $new = $current + 1;
        User::where('id', $user_id)->update(array('rating' => $new));
    }
    static public function decreaseUserRating($user_id)
    {
        $current = (int)User::where('id', $user_id)->first()->rating;
        $new = $current - 1;
        User::where('id', $user_id)->update(array('rating' => $new));
    }

    static public function sendEmailNotifications($data, $referer)
    {
        $data = json_decode($data);
        $recepients = Subscription::where('post_id', (int)$data->post_id)->get();

        $emailContent = [
            'user' => [],
            'author' => User::find((int)$data->user_id)->username,
            'post' => Posts::find((int)$data->post_id)->title,
            'content' => (string)$data->content,
            'unsubsribe' => $referer . "post/" . (int)$data->post_id
        ];
        foreach ($recepients as $recepient) {
            $user = User::find($recepient->user_id);
            $emailContent['user'] = $user;
            \Illuminate\Support\Facades\Mail::send('comment', $emailContent, function ($message) use ($user) {
                $message->to($user->email);
                $message->subject('New comment on a post you subscribed');
            });
        }
    }
}
