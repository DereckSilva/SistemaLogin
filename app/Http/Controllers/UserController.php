<?php

namespace App\Http\Controllers;

use App\Events\Coment;
use App\Events\TesteRetorno;
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

        $token = Auth::user()->createToken('tokenDereck')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login Efetuado com sucesso',
            'data'    => [
                'token' => $token
            ]
        ], 200);
    }

    public function comment(Request $request) {

        event(new Coment($request->comment));

        return response()
            ->json(['message' => 'comentário feito com sucesso']);
    }
}
