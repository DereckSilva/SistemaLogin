<?php

namespace App\Interface;

interface CadUserRepositoryInterface {
    public function insertNewUser($name, $email, $password);
    public function findEmail($email);
}
