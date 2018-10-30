<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherTypeRepository;
use App\Http\Controllers\API\BaseController;

class WeatherTypeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(WeatherTypeRepository $repository)
    {
        $this->repository = $repository;
    }
}
