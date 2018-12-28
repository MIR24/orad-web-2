<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherTypeRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class WeatherTypeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  WeatherTypeRepository  $repository
     * @return void
     */
    public function __construct(WeatherTypeRepository $repository)
    {
        parent::__construct($repository, 'weathertypes');
    }
}
