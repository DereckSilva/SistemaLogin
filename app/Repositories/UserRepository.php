<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends Base {

    /**
     * Nome da model
     *
     * @var $model
     */
    protected $model = 'User';

    /**
     * Retorna o email do usuário
     *
     * @author Dereck Silva
     * @since 30/04/2023
     * @param $email
     * @return User|NULL
     */
    public function findEmail($email): NULL|User
    {
        $email = User::where('email', '=', $email)->first();

        return $email;
    }

    /**
     * Retorna todos os usuários
     *
     * @author Dereck Silva
     * @since 30/04/2023
     * @return Collection
     */
    public function findAll(): Collection
    {
        $users = User::all();

        return $users;
    }
}
