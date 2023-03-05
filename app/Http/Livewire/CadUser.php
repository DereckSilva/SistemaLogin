<?php

namespace App\Http\Livewire;

use App\Rules\ConfirmPassword;
use Livewire\Component;

class CadUser extends Component
{

    public $message;
    public $email;
    public $password;
    public $confirmPassword;

    public function rules() {
        return [
            'email'           => 'required|email',
            'password'        => 'required',
            'confirmPassword' => ['required', new ConfirmPassword($this->password)]
        ];
    }

    protected $messages = [
        'email.required'           => 'Informe o e-mail de cadastro.',
        'email.email'              => 'O e-mail informado está no formato incorreto.',
        'password.required'        => 'Informe a senha',
        'confirmPassword.required' => 'Informe a senha de confirmação'
    ];

    public function sendEmail() {

        $this->validate();

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
