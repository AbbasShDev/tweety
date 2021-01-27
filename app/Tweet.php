<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Tweet extends Model {

    use likable;

    protected $fillable = ['body', 'user_id'];

    /**
     * @return string
     */
    public function getBodyAttribute($value)
    {
        $regex = "/@+[a-zA-Z0-9_.-]+/";
        $value = preg_replace($regex, '<span style="color: #2563EB;">[$0](/$0)</span>', $value);

        return $value;
    }

    public function isTweetedBy(User $user)
    {

        return $this->user_id == $user->id;
    }

    public function storeImage($image)
    {
        $this->image()->updateOrCreate([
            'tweetImage' => $image
        ]);
    }

    public function getImage()
    {
        return Storage::disk('s3')->url($this->image['tweetImage']);
    }


    public function image()
    {
        return $this->hasOne(TweetImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function likes()
    {
        return $this->hasMany(Like::class);
    }

}
