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
            'password'        => 'required|min:8',
            'confirmPassword' => ['required', new ConfirmPassword($this->password)]
        ];
    }

    protected $messages = [
        'name.required'            => 'Informe o nome completo do usuário.',
        'name.min'                 => 'É necessário no mínimo 10 caracteres.',
        'email.required'           => 'Informe o e-mail de cadastro.',
        'email.email'              => 'O e-mail informado está no formato incorreto.',
        'password.required'        => 'Informe a senha.',
        'password.min'             => 'É necessário no mínimo 8 caracteres.',
        'confirmPassword.min'      => 'É necessário no mínimo 8 caracteres.',
        'confirmPassword.required' => 'Informe a senha de confirmação.'
    ];

    public function cadUser() {

        $this->validate();

        $cadUserRepository = app('App\Repositories\CadUserRepository');

        $user = $cadUserRepository->insertNewUser($this->name, $this->email, $this->password);

        if (empty($user->error)) {
            SendMail::dispatch($this->name, $this->email)->onQueue('cadUser');
        }

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
            'error'   => $this->error,
        ]);
    }
}
