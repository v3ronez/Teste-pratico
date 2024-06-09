<?php

namespace App\Listeners;

use App\Events\SendEmailEvent;
use App\Notifications\UserNotification;

class SendUserEmail
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
     * @param  SendEmailEvent  $event
     *
     * @return void
     */
    public function handle(SendEmailEvent $event)
    {
        $event->user->notify(new UserNotification());
    }
}
