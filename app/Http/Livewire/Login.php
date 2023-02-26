<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Login extends Component
{
    /**
     * Auth about login
     *
     * @var object User
     */
    private $user;

    /**
     * Email user
     *
     * @var string
     */
    public $email;

    /**
     * Password user
     *
     * @var string
     */
    public $password;

    /**
     * Message error
     *
     * @var string
     */
    public $error;

    protected $rules = [
        'email' => 'required',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'e',
        'password.required' => 'd'
    ];

    public function validateForm()
    {

        $this->validate();

        $this->user = new UserController();

        $this->user->authenticate(['email' => $this->email, 'password' => $this->password]);

    }

    public function esqueceuSenha(){
        return redirect()->route('esqueceu_senha');
    }

    public function cadUser(){

        return redirect()->route('cadUser');

    }

    public function render()
    {

        return view('livewire.login',['error' => $this->error]);
    }
}
