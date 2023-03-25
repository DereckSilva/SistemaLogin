<?php

namespace App\Http\Livewire;

use App\Jobs\SendMail;
use Livewire\Component;

class EsqueceuSenha extends Component
{
    public $cod;
    public $email;
    public function sendCod() {
        $userRepository = app('App\Repositories\UserRepository');

        $user = $userRepository->findEmail($this->email);

        if (!empty($user->email)) {
            SendMail::dispatchSync($user->name, $this->email);
        }
    }

    public function confirmCod() {

    }

    public function render()
    {
        return view('livewire.esqueceu-senha');
    }
}
