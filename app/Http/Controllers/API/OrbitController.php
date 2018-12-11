<?php

namespace App\Http\Controllers\API;

use App\Repositories\OrbitRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class OrbitController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  OrbitRepository  $repository
     * @return void
     */
    public function __construct(OrbitRepository $repository)
    {
        parent::__construct($repository, 'orbits');
    }
}
