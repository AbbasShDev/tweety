<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function show() {

        $unreadNotifications = auth()->user()->unreadNotifications;
        $readNotifications = auth()->user()->readNotifications;

        $unreadNotifications->markAsRead();

        return view('notifications.show', compact('unreadNotifications', 'readNotifications'));
    }
}
