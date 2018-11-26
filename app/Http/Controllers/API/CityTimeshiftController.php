<?php

namespace App\Http\Controllers\API;

use App\Repositories\CityTimeshiftRepository;
use App\Http\Controllers\API\BaseController;

class CityTimeshiftController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  CityTimeshiftRepository  $repository
     * @return void
     */
    public function __construct(CityTimeshiftRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:create_citytimeshifts'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_citytimeshifts'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_citytimeshifts'])->only(['destroy']);
    }
}
