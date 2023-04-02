<?php

namespace App\Http\Controllers;

use App\Jobs\SendMail;
use App\Pipelines\SendEmailPipeline;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Pipeline\Pipeline;



class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function all() {
        return $this->repository->findAll();
    }

    public function create(Request $request) {

        try {
            $user = $request->all();

            $users = $this->repository->findEmail($user['email']);

            if (!empty($users)) {

                return Response(['message' => 'Esse email já está cadastrado'], 400)
                    ->header('Content-type', 'application/json');
            }

            //$this->repository->create($user);

            $this->index($user);

            return Response(['message' => 'Usuário Criado com Sucessosss'], 201)
                ->header('Content-type', 'application/json');
        }catch (HttpResponseException $error){
            
            DB::rollBack();

            return Response(['message' => $error->getMessage()], 500)
                ->header('Content-type', 'application/json');
        }
    }

    public function index($user) {
        app(Pipeline::class)
                ->send($user)
                ->through(SendEmailPipeline::class)
                ->thenReturn();
    }
}
