<?php

namespace App\Listeners;

use App\Jobs\SendMail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendEmailWelcome
{
    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        SendMail::dispatchSync( $event->user->name, $event->user->email );
    }
}
