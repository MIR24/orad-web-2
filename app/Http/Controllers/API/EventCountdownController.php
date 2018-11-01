<?php

namespace App\Http\Controllers\API;

use App\Repositories\EventCountdownRepository;
use App\Http\Controllers\API\BaseController;

class EventCountdownController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(EventCountdownRepository $repository)
    {
        $this->repository = $repository;
    }
}
