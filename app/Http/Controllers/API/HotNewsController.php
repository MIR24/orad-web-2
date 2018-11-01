<?php

namespace App\Http\Controllers\API;

use App\Repositories\HotNewsRepository;
use App\Http\Controllers\API\BaseController;

class HotNewsController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(HotNewsRepository $repository)
    {
        $this->repository = $repository;
    }
}
