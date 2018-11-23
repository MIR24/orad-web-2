<?php

namespace App\Http\Controllers\API;

use App\Repositories\NewsbarRepository;
use App\Http\Controllers\API\BaseController;

class NewsbarController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  NewsbarRepository  $repository
     * @return void
     */
    public function __construct(NewsbarRepository $repository)
    {
        $this->repository = $repository;
    }
}
