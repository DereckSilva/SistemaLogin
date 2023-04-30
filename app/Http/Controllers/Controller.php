<?php

namespace App\Http\Controllers;

use App\Http\Requests\CadUser\CadUserForApiRequest;
use App\Util\Trait\ApiResponse;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ApiResponse;

    /**
     * Função para retorno de todos os usuários
     *
     * @author Dereck Silva
     * @since 30/04/2023
     * @return mixed
     */
    public function all() {
        return $this->repository->findAll();
    }

    /**
     * Cria um novo usuário
     *
     * @author Dereck Silva
     * @since 30/04/2023
     * @param CadUserForApiRequest $request
     * @return Response
     */
    public function create(CadUserForApiRequest $request): JsonResponse {

        try {

            $user = $request->all();

            $users = $this->repository->findEmail($user['email']);

            if (!empty($users)) {

                return $this->error('E-mail já cadastrado', [], 400);
            }

            $this->repository->create($user);

            return $this->success('Usuário cadastrado com sucesso', $user, 201);
        } catch (HttpResponseException $error){

            DB::rollBack();

            return $this->error($error->getMessage(), [], 500);
        }
    }
}
