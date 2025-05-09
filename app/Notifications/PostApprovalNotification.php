<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\LostItemPost;

class PostApprovalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $post;

    public function __construct(LostItemPost $post)
    {
        $this->post = $post;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'post_id' => $this->post->id,
            'user_id' => $this->post->user_id,
            'title' => 'New post requires approval',
            'message' => "A new post '{$this->post->name}' needs approval.",
            'contact' => $this->post->contact,
        ];
    }
}