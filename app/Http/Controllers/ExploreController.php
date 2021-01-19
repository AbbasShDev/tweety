<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function __invoke() {
        return view('explore', [
            'users' => User::inRandomOrder()->paginate(50),
            'unreadNotifications' => $unreadNotifications = auth()->user()->unreadNotifications
        ]);
    }
}
