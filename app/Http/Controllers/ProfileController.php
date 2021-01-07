<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(User $user){
        return view('profile.show', compact('user'));
    }

    public function edit(User $user) {

//        $this->authorize('edit', $user);
//        abort_if(current_user()->isNot($user), '403');
        return view('profile.edit', compact('user'));

    }

    public function update(Request $request,User $user) {

        $attributes = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user),
                'alpha_dash'
            ],
            'avatar'=> ['file'],
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $attributes['username'] = '@'.$attributes['username'];

        if ($request->avatar){
            $attributes['avatar']   = $request->avatar->store('avatars');
        }

        $user->update($attributes);

        return redirect($user->path());
    }
}
