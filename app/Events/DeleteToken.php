<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeleteToken
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Cria uma nova instancia do evento passando como parâmetro o usuário
     */
    public function __construct(
        public User $user
    ){}
}
