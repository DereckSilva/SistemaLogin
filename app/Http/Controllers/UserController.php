<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $repository;

    public function __construct(UserRepository $repository) {
        $this->repository = $repository;
    }
    public function all(Request $request) {

        $ola = '';

        return $this->repository->findAll();
    }

    public function create(Request $request) {
        $request;

        $oi = '';

        return $this->repository->create($request);
    }
}
