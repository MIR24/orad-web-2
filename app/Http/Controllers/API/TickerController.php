<?php

namespace App\Http\Controllers\API;

use App\Repositories\TickerRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;
use App\Setting;

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
        parent::__construct($repository, 'tickers');
    }
}
