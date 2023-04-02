<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function all() {
        return $this->repository->findAll();
    }

    public function create(Request $request) {

        DB::beginTransaction();

        try {
            $user = $request->all();

            $users = $this->repository->findEmail($user['email']);

            if (!empty($users)) {

                return Response(['message' => 'Nenhum usuário foi encontrado'], 400)
                    ->header('Content-type', 'application/json');
            }

            //$this->repository->create($user);

            DB::commit();
            return Response(['message' => 'Usuário Criado com Sucesso'], 201)
                ->header('Content-type', 'application/json');
        }catch (HttpResponseException $error){
            DB::rollBack();

            return Response(['message' => $error->getMessage()], 500)
                ->header('Content-type', 'application/json');
        }
    }
}
