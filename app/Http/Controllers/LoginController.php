<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Realiza a autentica
     *
     * @return string | route
     */
    public function authenticate(array $user) {

        if (!Auth::attempt(['email' => $user['email'], 'password' => $user['password']])) {

            $error = 'Email or password incorreto';

            return redirect()->route('login')->with('error', $error);
        }

        Request()->session()->put('email', $user['email']);

        return redirect()->route('login');
    }
}
