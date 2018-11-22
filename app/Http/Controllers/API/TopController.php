<?php

namespace App\Http\Controllers\API;

use App\Repositories\TopRepository;
use App\Http\Controllers\API\BaseController;

class TopController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(TopRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:update_tops'])->only(['update', 'updateMultiple']);
    }
}
