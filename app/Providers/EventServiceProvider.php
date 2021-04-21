<?php

namespace App\Providers;

use App\Events\addImagenEvent;
use App\Events\HappyBirhdateEvent;
use App\Listeners\addImagenListener;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use App\Listeners\HappyBirhdateListener;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        HappyBirhdateEvent::class => [
            HappyBirhdateListener::class
        ],
        addImagenEvent::class => [
            addImagenListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
