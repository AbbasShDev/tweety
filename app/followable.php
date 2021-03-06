<?php


namespace App;


trait followable
{
    public function follow(User $user){
        return $this->follows()->save($user);
    }

    public function unfollow(User $user){
        return $this->follows()->detach($user);
    }

    public function toggleFollow(User $user){

       $this->follows()->toggle($user);
    }

    public function follows() {
        return $this->belongsToMany(
            User::class,
            'follows',
            'user_id',
            'following_user_id');
    }

    public function followers(){
        return $this->belongsToMany(
            User::class,
            'follows',
            'following_user_id',
            'user_id');
    }

    public function following(User $user) {
        return
            $this->follows()
            ->where('following_user_id', $user->id)
                ->exists();
    }

    public function followingsCount(){
        return $this->follows()->where('user_id', $this->id)->count();
    }

    public function followersCount(){
        return Follow::where('following_user_id', $this->id)->count();
    }
}
