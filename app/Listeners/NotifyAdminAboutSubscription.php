<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Events\UserSubscribedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserSubscribedNotification;

class NotifyAdminAboutSubscription
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(UserSubscribedEvent $event)
    {
        DB::table('news_letters')->insert([
            'email'=>$event->email,
            'created_at'=>now(),
            'updated_at'=>now(),
        ]);

        $admins=User::role(['admin','superadmin'])->get();
      
        Notification::send($admins, new UserSubscribedNotification($event->email));
    }
}
