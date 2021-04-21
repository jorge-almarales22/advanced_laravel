<?php

namespace App\Listeners;

use App\Notifications\HappyBirhdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class HappyBirhdateListener
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
    public function handle($event)
    {
        // var_dump($event->user);
        $event->user->notify(new HappyBirhdate($event->user));
    }
}
