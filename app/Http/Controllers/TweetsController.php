<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetsController extends Controller
{

    public function index()
    {
        return view('tweets.index',[
            'tweets' => auth()->user()->timeline()
        ]);
    }


    public function store(Request $request) {

        $tweetBody = $request->validate([
           'body'=> 'required|max:255'
        ]);

        Tweet::create([
            'user_id' => auth()->id(),
            'body' => $tweetBody['body']
        ]);

        return redirect('/home');
    }

}