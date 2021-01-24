<?php

namespace App\Http\Controllers;

use App\Notifications\TweetLiked;
use App\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    public function store(Tweet $tweet) {

        if ($tweet->isLikedBy(current_user())){
            $tweet->removeLikeDislike(current_user());

            $tweet->user->notifications()
                ->where('type', 'App\Notifications\TweetLiked')
                ->where('data->username', auth()->user()->username)
                ->first()
                ->delete();

        }else{

            $tweet->like(current_user());

            if ($tweet->user->id != current_user()->id){
                $tweet->user
                    ->notify(
                        new TweetLiked(
                            current_user()->username,
                            $tweet->body,
                            $tweet->image ? $tweet->image['tweetImage'] : null
                        )
                    );
            }
        }

        return redirect()->back();
    }

    public function destroy(Tweet $tweet) {

        if ($tweet->isLikedBy(current_user()) && $tweet->user->id != current_user()->id){
            $tweet->user->notifications()
                ->where('type', 'App\Notifications\TweetLiked')
                ->where('data->username', auth()->user()->username)
                ->first()
                ->delete();
        }

        if ($tweet->isDisLikedBy(current_user())){
            $tweet->removeLikeDislike(current_user());
        }else{
            $tweet->disLike(current_user());
        }

        return redirect()->back();
    }
}
