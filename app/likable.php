<?php


namespace App;


use Illuminate\Database\Eloquent\Builder;

trait likable
{

    public function scopeWithLikes(Builder $query) {

        $query->leftJoinSub(
            'SELECT tweet_id ,SUM(liked) likes, SUM(!liked) dislikes FROM likes GROUP BY tweet_id',
            'likes',
            'likes.tweet_id',
            '=',
            'tweets.id'
        );
    }
    public function like($user = null, $liked = true){
        $this->likes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id()
        ],
            [
                'liked' => $liked
            ]
        );
    }

    public function disLike($user = null) {
        $this->like($user, false);
    }

    public function isLikedBy(User $user) {
        return (bool)$this->likes()
            ->where('tweet_id', $this->id)
            ->where('liked' , true)
            ->count();
    }

    public function isDisLikedBy(User $user) {
        return (bool)$this->likes()
            ->where('tweet_id', $this->id)
            ->where('liked' , false)
            ->count();
    }
}
