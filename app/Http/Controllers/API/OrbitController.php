<?php

namespace App\Http\Controllers\API;

use App\Repositories\OrbitRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class OrbitController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  OrbitRepository  $repository
     * @return void
     */
    public function __construct(OrbitRepository $repository)
    {
        parent::__construct($repository, 'orbits');
    }

    /**
     * Register actions access permissions.
     *
     * @return void
     */
    protected function registerActionPermissions()
    {
        $this->middleware(['log_everything']);
        $this->middleware(['permission:see_'.$this->resource.'|see_hotnews']);
        $this->middleware(['permission:create_'.$this->resource])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_'.$this->resource])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_'.$this->resource])->only(['destroy']);
    }

}
