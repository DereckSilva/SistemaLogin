<?php

namespace App\Listeners;

use App\Events\Coment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class ComentedPost
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Coment $event): void
    {
        Storage::put('exemplse.txt', $event->comment());
    }
}
