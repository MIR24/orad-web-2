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
     * @param  WeatherForecastRepository  $repository
     * @return void
     */
    public function __construct(WeatherForecastRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:create_weatherforecasts'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_weatherforecasts'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_weatherforecasts'])->only(['destroy']);
    }
}
