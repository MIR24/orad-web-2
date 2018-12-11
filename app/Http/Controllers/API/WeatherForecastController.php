<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherForecastRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class WeatherForecastController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  WeatherForecastRepository  $repository
     * @return void
     */
    public function __construct(WeatherForecastRepository $repository)
    {
        parent::__construct($repository, 'weatherforecasts');
    }
}
