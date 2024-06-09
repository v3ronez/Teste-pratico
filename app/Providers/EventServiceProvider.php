<?php

namespace App\Providers;

use App\Events\SendEmailEvent;
use App\Listeners\SendUserEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen
        = [
            'App\Events\Event'    => [
                'App\Listeners\EventListener',
            ],
            SendEmailEvent::class => [
                SendUserEmail::class
            ],
        ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
