<?php

namespace App\Http\Controllers;

use App\Events\Coment;
use App\Events\TesteRetorno;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    /**
     * Acesso ao repositório da classe
     *
     * @var $repository
     */
    protected $repository;

    /**
     * Inicializa o repositório da classe no momento da instancia da classe
     *
     * @param UserRepository $repository
     */
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

        event(new Coment($request->comment));

        return response()
            ->json(['message' => 'comentário feito com sucesso']);
    }
}
