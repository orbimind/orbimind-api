<?php

namespace App\Http\Controllers;

use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Subscription;
use App\Models\Handler;
use App\Models\Posts;

class SubscriptionController extends Controller
{
    public function __construct()
    {
        $this->user = JWTAuth::user(JWTAuth::getToken());
    }

    public function createSubscription(int $post_id)
    {
        if (!$post = Posts::find($post_id))
            return response([
                'message' => 'This post does not exist'
            ], 404);
        if (!Handler::authenticatedAsAdmin($this->user) && $post->status == false)
            return response([
                'message' => 'You can not subscribe to this post'
            ], 401);

        if (Subscription::where('post_id', $post_id)->where('user_id', $this->user->id)->first())
            return $this->removeSubscription($post_id);

        return response([
            'message' => 'Subscription was successfully created',
            'data' => Subscription::create([
                'user_id' => $this->user->id,
                'post_id' => $post_id
            ])
        ]);
    }

    public function removeSubscription(int $post_id)
    {
        if (!Posts::find($post_id))
            return response([
                'message' => 'This post does not exist'
            ], 404);

        if (Subscription::where('post_id', $post_id)->where('user_id', $this->user->id)->delete())
            return response([
                'message' => 'Subscription was successfully deleted'
            ]);
        else
            return response([
                'message' => 'No subscriptions found'
            ]);
    }
}
