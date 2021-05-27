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

        $subs = $this->user->subs;
        if ($subs == null) {
            $subs = array();
            array_push($subs, $post_id);
            \App\Models\User::find($this->user->id)->update(['subs' => $subs]);
            return response([
                'message' => 'Subscription was successfully created',
                'data' => Subscription::create([
                    'user_id' => $this->user->id,
                    'post_id' => $post_id
                ])
            ]);
        }

        foreach ($subs as $key)
            if ($key == $post_id)
                return $this->removeSubscription($post_id);

        array_push($subs, $post_id);
        \App\Models\User::find($this->user->id)->update(['subs' => $subs]);

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

        if (!$subs = $this->user->subs)
            return response([
                'message' => 'No subscriptions found'
            ], 404);

        $result = array();
        foreach ($subs as $key) {
            if ($key == $post_id)
                continue;
            array_push($result, (int)$key);
        }
        if ($result == [])
            $result = null;

        \App\Models\User::find($this->user->id)->update(['subs' => $result]);

        Subscription::where('post_id', $post_id)->where('user_id', $this->user->id)->delete();
        return response([
            'message' => 'Subscription was successfully deleted'
        ]);
    }
}
