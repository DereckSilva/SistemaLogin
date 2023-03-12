<?php

namespace App\Repositories;

use App\Interface\CadUserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class CadUserRepository implements CadUserRepositoryInterface {

    public function insertNewUser($name, $email, $password)
    {
        DB::beginTransaction();

        try {


            User::create([
                'name'     => $name,
                'email'    => $email,
                'password' => $password
            ]);

            DB::commit();

            $success = 'Usuário cadastrado com sucesso';

            return redirect()->route('cadUser')->with([ 'message' => $success ]);

        } catch (QueryException $error) {

            DB::rollBack();
            $this->findEmail($email);
            $erro = 'Erro ao cadastrar o usuário';

            return redirect()->route('cadUser')->with([ 'error' => $erro ]);
        }

    }

    public function findEmail($email)
    {
        $emaild = User::where('email', '=', $email)->get();

        if (!empty($emaild)) {
            return redirect()->route('cadUser')->with([ 'error' => 'Email já cadastrado' ]);
        }
    }
}
