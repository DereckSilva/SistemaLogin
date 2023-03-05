<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @return string | route
     */
    public function authenticate(array $user) {

        if (!Auth::attempt(['email' => $user['email'], 'password' => $user['password']])) {

            $error = 'Email or password incorrect';

            return redirect()->route('login')->with('error', $error);
        }

        Request()->session()->put('email', $user['email']);

        return redirect()->route('login');
    }
}
