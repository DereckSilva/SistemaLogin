<?php

namespace App\Listeners;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use function Pest\Laravel\delete;

class DeleteToken
{
    /**
     * Create the event listener.
     */

    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        $this->user->tokens()->delete();
    }
}
