<?php

namespace App\Http\Controllers\API;

use App\Repositories\OrbitRepository;
use App\Http\Controllers\API\BaseController;

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
        $this->repository = $repository;
        $this->middleware(['can:create_orbits'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_orbits'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_orbits'])->only(['destroy']);
    }
}