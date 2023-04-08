<?php

namespace App\Http\Controllers;

use App\Events\Coment;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }

    public function login(Request $request) {

        $user = $request->all();

        if (!Auth::attempt(['email' => $user['email'], 'password' => $user['password']])) {

            $error = 'Email ou senha incorreto';

            return Response([ "message" => $error ], 400)
                    ->header('Content-type', 'application/json');
        }

        return Response([ "messsage" => 'Login Efetuado' ], 200)
                ->header('Content-type', 'application/json');
    }

    public function comment(Request $request) {

        Coment::dispatch($request->comment);

        return response()
                ->json(['message' => 'comentário feito com sucesso']);

    }
}
