<?php

namespace App\Http\Controllers;

use App\Events\Coment;
use App\Events\TesteRetorno;
use App\Http\Util\Trait\ApiResponse;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Http\JsonResponse;

class UserController extends Controller
{

    use ApiResponse;

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

    /**
     * Realiza o login do usuário
     *
     * @author Dereck Silva
     * @since 30/04/2023
     * @return JsonResponse
     */
    public function login(): JsonResponse  {

        $token = Auth::user()->createToken('tokenDereck')->plainTextToken;

        return $this->success('Login Efetuado com sucesso', [
            'data' => $token
        ], 201);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function comment(Request $request) {

        event(new Coment($request->comment));

        return response()
            ->json(['message' => 'comentário feito com sucesso']);
    }
}
