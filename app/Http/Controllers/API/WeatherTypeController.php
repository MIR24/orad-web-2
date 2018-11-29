<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherTypeRepository;
use App\Http\Controllers\API\BaseController;

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
        $this->repository = $repository;
        $this->middleware(['permission:see_weathertypes']);
        $this->middleware(['permission:create_weathertypes'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_weathertypes'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_weathertypes'])->only(['destroy']);
    }
}
