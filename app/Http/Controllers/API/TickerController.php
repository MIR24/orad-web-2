<?php

namespace App\Http\Controllers\API;

use App\Repositories\TickerRepository;
use App\Http\Controllers\API\BaseController;

class TickerController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  TickerRepository  $repository
     * @return void
     */
    public function __construct(TickerRepository $repository)
    {
        $this->repository = $repository;
    }
}
