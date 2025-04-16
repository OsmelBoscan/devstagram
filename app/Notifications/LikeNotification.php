<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LikeNotification extends Notification
{
    use Queueable;

    protected $post;
    protected $user;

    public function __construct($post, $user)
    {
        $this->post = $post;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => "{$this->user->username} le dio like a tu publicación.",
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'username' => $this->post->user->username, // Incluye el username del autor del post
        ];
    }
}