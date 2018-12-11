<?php

namespace App\Http\Controllers\API;

use App\Repositories\CityTimeshiftRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

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
        parent::__construct($repository, 'citytimeshifts');
    }
}
