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
        $this->middleware(['permission:see_settings']);
        $this->middleware(['permission:create_settings'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_settings'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_settings'])->only(['destroy']);
    }
}
