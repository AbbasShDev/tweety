<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user){

        if(auth()->user()->following($user)){
            $msg = "You Unfollowed $user->username";
        }else{
            $msg = "You Followed $user->username";
        }

        auth()->user()->toggleFollow($user);

        return redirect()->back()->with('Message', $msg);
    }
}
