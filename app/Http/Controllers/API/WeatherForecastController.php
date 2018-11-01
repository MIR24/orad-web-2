<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherForecastRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonCollectionResource;
use Illuminate\Http\Request;

class WeatherForecastController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(WeatherForecastRepository $repository)
    {
        $this->repository = $repository;
    }
}
