<?php

namespace App\Http\Controllers;

use App\Follow;
use App\User;
use Illuminate\Http\Request;

class FollowersController extends Controller
{
    public function index(User $user){

      return view('profile.followers', [
          'users' => $user->followers()->paginate(50),
          'unreadNotifications' => $unreadNotifications = auth()->user()->unreadNotifications
      ]);

    }
}
