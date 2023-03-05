<?php

namespace App\Interface;

interface CadUserRepositoryInterface {
    public function insertNewUser($email, $password);
}
