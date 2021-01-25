<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowingsController extends Controller
{
    public function index(User $user){

        return view('profile.followings', [
            'users'               => $user->follows()->paginate(50),
            'unreadNotifications' => $unreadNotifications = auth()->user()->unreadNotifications
        ]);

    }
}
