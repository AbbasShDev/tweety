<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    public function store(Tweet $tweet) {

        if ($tweet->isLikedBy(current_user())){
            $tweet->removeLikeDislike(current_user());
        }else{
            $tweet->like(current_user());
        }

        return redirect()->back();
    }

    public function destroy(Tweet $tweet) {

        if ($tweet->isDisLikedBy(current_user())){
            $tweet->removeLikeDislike(current_user());
        }else{
            $tweet->disLike(current_user());
        }

        return redirect()->back();
    }
}
