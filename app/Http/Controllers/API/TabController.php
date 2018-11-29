<?php

namespace App\Http\Controllers\API;

use App\Repositories\TabRepository;
use App\Http\Controllers\API\BaseController;

class TabController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  TabRepository  $repository
     * @return void
     */
    public function __construct(TabRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_tabs']);
        $this->middleware(['permission:create_tabs'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_tabs'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_tabs'])->only(['destroy']);
    }
}
