<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetsController extends Controller
{

    public function index()
    {
        return view('tweets.index',[
            'tweets' => auth()->user()->timeline(),
            'unreadNotifications' => $unreadNotifications = auth()->user()->unreadNotifications
        ]);
    }


    public function store(Request $request) {

        $attributes = $request->validate([
           'body'=> ['required','max:300'],
           'tweetImage'=> ['image','mimes:jpg,gif,png,jpeg','max:4096'],
        ]);

        $tweet = Tweet::create([
            'user_id' => auth()->id(),
            'body' => $attributes['body']
        ]);

        if ($request->tweetImage){
           $tweet->storeImage($request->tweetImage->store('tweets-image'));
        }

        return redirect(route('home'))->with('Message','Tweet published');
    }

    public function destroy(Tweet $tweet) {
        $tweet->delete();

        return redirect()->back()->with('Message','Tweet deleted');
    }

}
