<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Models\Post;

class NewPost extends Notification
{
    use Queueable;
    protected $following;
    protected $post;    

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $following, Post $post)
    {
        $this->following = $following;
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'name' => $this->following->name,
                'fullname' => $this->following->fullname,
                'profile_photo_url' => $this->following->profile_photo_url,
                'item' => $this->post->item,
                'created_at' =>   date( "Y-m-d H:i", strtotime($this->post->created_at ) ),
                'title' => substr($this->post->title,0,25) ,

            ],
        ];
    }

    public function toDatabase($notifiable)
    {
    
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'name' => $this->following->name,
                'fullname' => $this->following->fullname,
                'profile_photo_url' => $this->following->profile_photo_url,
                'item' => $this->post->item,
                'created_at' =>   date( "Y-m-d H:i", strtotime($this->post->created_at ) ),
                'title' => substr($this->post->title,0,25) ,

            ],
        ];
    } 
}
