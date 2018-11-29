<?php

namespace App\Http\Controllers\API;

use App\Repositories\TopRepository;
use App\Http\Controllers\API\BaseController;

class TopController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  TopRepository  $repository
     * @return void
     */
    public function __construct(TopRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_tops']);
        $this->middleware(['permission:create_tops'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_tops'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_tops'])->only(['destroy']);
    }
}
