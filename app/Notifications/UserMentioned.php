<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserMentioned extends Notification
{
    use Queueable;

    private $username, $tweet, $tweetImage;

    public function __construct($username, $tweet, $tweetImage = null)
    {
        $this->username = $username;
        $this->tweet = $tweet;
        $this->tweetImage = $tweetImage;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'username'  => $this->username,
            'tweet'     => $this->tweet,
            'tweetImage'=> $this->tweetImage,
        ];
    }
}
