<?php

namespace App\Repositories;


use App\Models\User;
use Illuminate\Support\Facades\DB;

class Base {

    public function create(array $input) {

        User::create([
                'name'  => $input['name'],
                'email' => $input['email'],
                'password' => $input['password']
            ]);
    }
}
