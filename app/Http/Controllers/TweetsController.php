<?php

namespace App\Http\Controllers;

use App\Notifications\UserMentioned;
use App\Tweet;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
           'body'=> ['required','max:255'],
           'tweetImage'=> ['image','mimes:jpg,gif,png,jpeg','max:4096'],
        ]);

        $tweet = Tweet::create([
            'user_id' => auth()->id(),
            'body' => strip_tags($attributes['body'])
        ]);

        if ($request->tweetImage){
           $tweet->storeImage($request->tweetImage->store('tweets-image'));
        }

        $regex = "/@+[a-zA-Z0-9_.-]+/";
        preg_match_all($regex, $attributes['body'],$mentions);
        $mentions = array_unique($mentions[0]);

        foreach ($mentions as $mention){
            $user = User::where('username',$mention)->first();

            $user->notify(
                new UserMentioned(
                    current_user()->username,
                    $attributes['body'],
                    $tweet->image ? $tweet->image['tweetImage'] : null)
            );
        }

        return redirect(route('home'))->with('Message','Tweet published');
    }

    public function destroy(Tweet $tweet) {

        if ($tweet->image){
            Storage::delete($tweet->image['tweetImage']);
        }

        $tweet->delete();

        return redirect()->back()->with('Message','Tweet deleted');
    }

}
