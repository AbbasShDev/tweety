<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetLikeController extends Controller
{
    public function store(Tweet $tweet) {

        $tweet->like(current_user());

        return redirect()->back();
    }

    public function destroy(Tweet $tweet) {

        $tweet->disLike(current_user());

        return redirect()->back();
    }
}
