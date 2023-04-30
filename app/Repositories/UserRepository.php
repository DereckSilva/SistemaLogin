<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends Base {

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
