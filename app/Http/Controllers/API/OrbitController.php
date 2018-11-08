<?php

namespace App\Http\Controllers\API;

use App\Repositories\OrbitRepository;
use App\Http\Controllers\API\BaseController;

class OrbitController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(OrbitRepository $repository)
    {
        $this->repository = $repository;
    }
}