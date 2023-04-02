<?php

namespace App\Http\Livewire;

use App\Jobs\SendMail;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class CadUser extends Component
{

    public $message, $error, $name, $email, $password, $confirmed;

    public function rules() {
        return [
            'name'            => 'required|min:10',
            'email'           => 'required|email',
            'password'        => ['required', Password::min(8)->mixedCase()->numbers()],
            'confirmed'       => ['required', Password::min(8)->mixedCase()->numbers(), function ($attribute, $value, $fail) {
                if ($value !== $this->password) {
                    $fail('As senhas são diferentes.');
                }
            }]
        ];
    }

    public function cadUser() {

        $this->validate();

        $userRepository = app('App\Repositories\UserRepository');

        $user = $userRepository->create(['email'=>'cdddd', 'name'=> 'c', 'password'=>'ddd']);

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
