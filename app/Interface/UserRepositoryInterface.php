<?php

namespace App\Interface;

use App\Models\User;
use Illuminate\Routing\Redirector;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface {
    public function insertNewUser($name, $email, $password): Redirector;
    public function findEmail($email): NULL|User;
    public function findAll(): Collection;
}
