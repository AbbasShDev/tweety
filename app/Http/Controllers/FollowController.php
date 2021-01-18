<?php

namespace App\Http\Controllers;

use App\Notifications\UserFollowed;
use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user){

        if(auth()->user()->following($user)){
            $msg = "You Unfollowed $user->username";

            $user->notifications()
                ->where('type', 'App\Notifications\UserFollowed')
                ->where('data->username', auth()->user()->username)
                ->first()
                ->delete();
        }else{
            $msg = "You Followed $user->username";
            $user->notify(new UserFollowed(auth()->user()->username));
        }

        auth()->user()->toggleFollow($user);

        return redirect()->back()->with('Message', $msg);
    }
}
