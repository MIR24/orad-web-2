<?php

namespace App\Http\Controllers\API;

use App\Repositories\PromoCategoryRepository;
use App\Http\Controllers\API\BaseController;

class PromoCategoryController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(PromoCategoryRepository $repository)
    {
        $this->repository = $repository;
    }
}
