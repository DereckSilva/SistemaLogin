<?php

namespace App\Http\Livewire;

use App\Jobs\SendMail;
use App\Rules\ConfirmPassword;
use Livewire\Component;

class CadUser extends Component
{

    public $message;
    public $error;
    public $name;
    public $email;
    public $password;
    public $confirmPassword;

    public function rules() {
        return [
            'name'            => 'required|min:10',
            'email'           => 'required|email',
            'password'        => 'required',
            'confirmPassword' => ['required', new ConfirmPassword($this->password)]
        ];
    }

    protected $messages = [
        'name'                     => 'Informe o nome completo do usuário',
        'email.required'           => 'Informe o e-mail de cadastro.',
        'email.email'              => 'O e-mail informado está no formato incorreto.',
        'password.required'        => 'Informe a senha',
        'confirmPassword.required' => 'Informe a senha de confirmação'
    ];

    public function cadUser() {

        $this->validate();

        $cadUserRepository = app('App\Repositories\CadUserRepository');

        $user = $cadUserRepository->insertNewUser($this->name, $this->email, $this->password);

    }

    /*
     * Return page to login
     * */
    public function login() {
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.cad-user', [
            'message' => $this->message,
            'error'   => $this->error
        ]);
    }
}
