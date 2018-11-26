<?php

namespace App\Http\Controllers\API;

use App\Repositories\HotNewsRepository;
use App\Http\Controllers\API\BaseController;

class HotNewsController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  HotNewsRepository  $repository
     * @return void
     */
    public function __construct(HotNewsRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:create_hotnews'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_hotnews'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_hotnews'])->only(['destroy']);
    }
}
