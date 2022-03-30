<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCustomOrder extends Notification
{
    use Queueable;

    public $customOrder;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($customOrder)
    {
        $this->customOrder=$customOrder;
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

    public function toDatabase()
    {
        return [
                'title'=>'You have a new custom order',
                'email'=>$this->customOrder->email,
                'city'=>$this->customOrder->city,
                'date'=>$this->customOrder->date,
              
        ];
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
