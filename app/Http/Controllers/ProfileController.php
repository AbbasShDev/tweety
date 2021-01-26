<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller {


    public function show(User $user)
    {
        return view('profile.show', [
            'user'                => $user,
            'tweets'              => $user->tweets()
                ->orderByDesc('id')
                ->withLikes()->paginate(50),
            'unreadNotifications' => $unreadNotifications = auth()->user()->unreadNotifications
        ]);
    }

    public function edit(User $user)
    {

//        $this->authorize('edit', $user);
//        abort_if(current_user()->isNot($user), '403');
        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('profile.edit', compact('user', 'unreadNotifications'));

    }

    public function update(Request $request, User $user)
    {

        $attributes = $request->validate([
            'username'    => [
                'required',
                'string',
                'max:255',
                Rule::unique('users')->ignore($user),
                'alpha_dash'
            ],
            'avatar'      => ['file', 'mimes:jpg,gif,png,jpeg', 'max:4096'],
            'header'      => ['file', 'mimes:jpg,gif,png,jpeg', 'max:4096'],
            'description' => ['max:255'],
            'name'        => ['required', 'string', 'max:255'],
            'email'       => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user)
            ],
            'password'    => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $attributes['username'] = '@' . $attributes['username'];
        $attributes['password'] = Hash::make($attributes['password']);

        if ($request->avatar) {

            if ($user->avatar) {
                $avatar = str_replace(asset("storage/"), '', $user->avatar);
                Storage::delete($avatar);
            }

            $attributes['avatar'] = $request->avatar->store('avatars');

        }

        if ($request->header) {

            if ($user->header) {
                $header = str_replace(asset("storage/"), '', $user->header);
                Storage::delete($header);
            }

            $attributes['header'] = $request->header->store('headers');
        }

        $user->update($attributes);

        return redirect($user->path())->with('Message', "Profile updated");
    }
}
