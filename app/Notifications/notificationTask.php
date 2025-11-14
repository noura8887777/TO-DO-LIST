<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class notificationTask extends Notification
{
    use Queueable;
    public $user;
    public $taskPendingNotifiy;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user,$taskPendingNotifiy)
    {
        $this->user=$user;
        $this->taskPendingNotifiy=$taskPendingNotifiy;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    // ->subject('bonjour dans votre plateform')
                    // ->greeting('bonjour'. $this->user->name)
                    // ->line('il y a des tasks pending')
                    // ->action('acceder a votre compte', url('/tasks'))
                    // ->line('Thank you for using our application!') 
                    ->markdown('emails.notification',[
                    'user'=>$this->user,
                    'taskPendingNotifiy'=>$this->taskPendingNotifiy
                ]); 
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
            //
        ];
    }
}
