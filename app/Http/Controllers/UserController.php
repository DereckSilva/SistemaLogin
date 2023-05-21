<?php

namespace App\Http\Controllers;

use App\Events\Coment;
use App\Events\TesteRetorno;
use App\Http\Requests\ForgetPassword;
use App\Jobs\SendMail;
use App\Repositories\UserRepository;
use App\Util\Trait\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function comment(Request $request) {

        event(new Coment($request->comment));

        return response()
            ->json(['message' => 'comentário feito com sucesso']);
    }

    public function forgetPassword(ForgetPassword $forgetPassword) {

        /* Verifica se o e-mail está cadastrado no sistema */
        $user = $this->repository->findEmail($forgetPassword->email);

        /* Caso não encontre o e-mail, uma exception é retornada ao usuário */
        if (empty($user)) {
            $this->httpException('Este e-mail não está cadastrado', [], 404);
        }

        /* Gera o código para o usuário setar uma nova senha */
        $code = rand(10000, 99999);
        Cache::set('codePassword', $code, 60);

        /* Envia o e-mail para o usuário */
        SendMail::dispatchSync('dereck', $user->email, true, $code);

        return $this->success('Email enviado com sucesso', [ 'user' => $user ], 200);
    }

    public function confirmCode() {

        /* Recupera o código gerado */
        $rememberCode = Cache::get('codePassword');

        /* Caso o código expire, gera um erro na tela */
        if (empty($rememberCode)) {
            $this->httpException('O código expirou, tente novamente!', [], 500);
        }

        $this->success('Código correto', [], 200);
    }

    public function resetPassword() {
        $this->repository->resetPassword();
    }
}
