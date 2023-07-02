<?php

namespace App\Http\Controllers;

use App\Events\Coment;
use App\Events\TesteRetorno;
use App\Http\Requests\ForgetPassword;
use App\Http\Requests\ResetPassword;
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
     * @param UserRepository\ $repository
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
    public function login(Request $request): JsonResponse  {

        $token = Auth::user()->createToken('tokenDereck')->plainTextToken;
        $rememberToken = $this->repository->findEmail($request->email)->remember_token;

        return $this->success('Login Efetuado com sucesso', [
            'token'    => $token,
            'remember' => $rememberToken
        ], 200);
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

    /**
     * Reseta a senha do usuário
     *
     * @author Dereck Silva
     * @since 04/06/2023
     * @param ResetPassword $resetPassword
     * @return JsonResponse;
     */
    public function resetPassword(ResetPassword $resetPassword) {

        $this->repository->resetPassword($resetPassword->email, $resetPassword->password);

        return $this->success('Senha alterada com sucesso', [], 200);
    }

    public function rememberMe(Request $request) {
        $token = $request->remember;

        if (empty($token)) {
            return $this->httpException('Nenhum token informado', [], 400);
        }

        $token = json_decode($token)->valor;
        $tokenUser = $this->repository->rememberMe($token);

        if (empty($tokenUser)) {
            return $this->httpException('O token informado não consta na base de dados', [], 400);
        }

        return $this->success('Token encontrado com sucesso', ['user' => $tokenUser], 200);
    }
}
