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
        $this->middleware(['can:see_tabs']);
        $this->middleware(['can:create_tabs'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_tabs'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_tabs'])->only(['destroy']);
    }
}
