<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class MentionController extends Controller
{
    public function index(Request $request)
    {
        $data = [];
        $users = User::select('username')
            ->where('username', 'like', "%$request->text%")
            ->get();

        foreach ($users as $user) {
            $raw_username = explode('@', $user->username);
            $data[] = ['key' => $raw_username[1], 'value' => $user->username];
        }

        return json_encode($data);
    }
}
