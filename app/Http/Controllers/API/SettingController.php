<?php

namespace App\Http\Controllers\API;

use App\Repositories\SettingRepository;
use App\Http\Controllers\API\BaseController;

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
        $this->repository = $repository;
    }
}
