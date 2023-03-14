<?php

namespace App\Interface;

use App\Models\User;
use Illuminate\Routing\Redirector;

interface CadUserRepositoryInterface {
    public function insertNewUser($name, $email, $password): Redirector;
    public function findEmail($email): NULL|User;
}
