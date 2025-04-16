<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CommentNotification extends Notification
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
            'message' => "{$this->user->username} comentó en tu publicación.",
            'post_id' => $this->post->id,
            'user_id' => $this->user->id,
            'username' => $this->post->user->username, // Agrega el username del autor del post
        ];
    }
}