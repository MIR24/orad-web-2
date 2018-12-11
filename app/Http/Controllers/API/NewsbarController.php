<?php

namespace App\Http\Controllers\API;

use App\Repositories\NewsbarRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;
use App\Setting;

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
        parent::__construct($repository, 'newsbars');
    }
}
