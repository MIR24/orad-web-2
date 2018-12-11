<?php

namespace App\Http\Controllers\API;

use App\Repositories\SettingRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  SettingRepository  $repository
     * @return void
     */
    public function __construct(SettingRepository $repository)
    {
        parent::__construct($repository, 'settings');
    }
}
