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
    }
}
