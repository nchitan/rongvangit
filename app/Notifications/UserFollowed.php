<?php

namespace App\Notifications;

use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class UserFollowed extends Notification
{

    use Queueable;
    protected $follower;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($follower)
    {

        $this->follower = $follower;
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
    // public function toMail($notifiable)
    // {
    //     return (new MailMessage)
    //                 ->line('The introduction to the notification.')
    //                 ->action('Notification Action', url('/'))
    //                 ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    // public function toArray($notifiable)
    // {
    //     return [
    //         //
    //     ];
    // }
    public function toArray($notifiable)
    {
        return [
            'id' => $this->id,
            'read_at' => null,
            'data' => [
                'created_at' =>   date( "Y-m-d H:m", strtotime($this->follower->created_at ) ),
                'name' => $this->follower->name,
                'fullname' => $this->follower->fullname,
                'profile_photo_url' => $this->follower->profile_photo_url,
            ],
        ];
    }
    public function toDatabase($notifiable)
    {
      
        return [
            'created_at' =>   date( "Y-m-d H:m", strtotime($this->follower->created_at ) ),


            'name' => $this->follower->name,
            'fullname' => $this->follower->fullname,
            'profile_photo_url' => $this->follower->profile_photo_url,
        ];
    }    
}






