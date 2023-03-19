<?php

namespace App\Repositories;

use App\Interface\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements UserRepositoryInterface {

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

    public function findAll(): Collection
    {
        $users = User::all();

        return $users;
    }
}
