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
        $this->middleware(['can:see_tops']);
        $this->middleware(['can:create_tops'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_tops'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_tops'])->only(['destroy']);
    }
}
