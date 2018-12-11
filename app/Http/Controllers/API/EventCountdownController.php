<?php

namespace App\Http\Controllers\API;

use App\Repositories\EventCountdownRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class EventCountdownController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  EventCountdownRepository  $repository
     * @return void
     */
    public function __construct(EventCountdownRepository $repository)
    {
        parent::__construct($repository, 'eventcountdowns');
    }
}
