<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherForecastLinerRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class WeatherForecastLinerController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  WeatherForecastLinerRepository  $repository
     * @return void
     */
    public function __construct(WeatherForecastLinerRepository $repository)
    {
        parent::__construct($repository, 'weatherforecastsliners');
    }
}
