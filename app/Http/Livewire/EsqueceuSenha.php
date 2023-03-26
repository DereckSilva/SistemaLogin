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
        $user           = $userRepository->findEmail($this->email);

        if (!empty($user->email)) {

            $this->cod = random_int(100000,999999);
            SendMail::dispatchSync($user->name, $this->email, true, $this->cod);
        }
    }

    public function confirmCod() {

    }

    public function render()
    {
        return view('livewire.esqueceu-senha');
    }
}
