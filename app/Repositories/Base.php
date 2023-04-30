<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\DB;

class Base {

    public function create(array $input) {

        // to-do: refatoração de create, deixar mais abstrato para qualquer tabela
        User::create([
                'name'  => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password'])
            ]);
    }
}
