<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CadUser extends Component
{

    public $message;

    public function sendEmail() {

        $this->message = 'Usuário cadastrado com sucesso!';

    }

    /*
     * Return page to login
     * */
    public function login() {
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.cad-user', ['message' => $this->message]);
    }
}
