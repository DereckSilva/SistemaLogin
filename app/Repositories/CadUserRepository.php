<?php

namespace App\Repositories;

use App\Interface\CadUserRepositoryInterface;
use App\Models\User;
use  App\Jobs\SendMail;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;

class CadUserRepository implements CadUserRepositoryInterface {

    public function insertNewUser($name, $email, $password): Redirector
    {
        DB::beginTransaction();

        try {
            $user = $this->findEmail($email);

            if (!empty($user)) return redirect()->route('cadUser')->with([ 'error' => 'Email já cadastrado' ]);

            User::create([
                'name'     => $name,
                'email'    => $email,
                'password' => bcrypt($password)
            ]);

            DB::commit();

            $success = 'Usuário cadastrado com sucesso';

            SendMail::dispatch($name, $email);

            return redirect()->route('cadUser')->with([ 'message' => $success ]);

        } catch (QueryException $error) {

            DB::rollBack();

            $erro = 'Erro ao cadastrar o usuário';

            return redirect()->route('cadUser')->with([ 'error' => $erro ]);
        }

    }

    public function findEmail($email): NULL|User
    {
        $email = User::where('email', '=', $email)->first();

        return $email;
    }
}
