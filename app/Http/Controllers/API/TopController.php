<?php

namespace App\Http\Controllers\API;

use App\Repositories\TopRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;
use App\Setting;

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
        parent::__construct($repository, 'tops');
    }
}
