<?php

namespace App\Http\Controllers\API;

use App\Repositories\PromoCategoryRepository;
use App\Http\Controllers\API\BaseController;

class PromoCategoryController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  PromoCategoryRepository  $repository
     * @return void
     */
    public function __construct(PromoCategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_promocategories']);
        $this->middleware(['permission:create_promocategories'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_promocategories'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_promocategories'])->only(['destroy']);
    }
}
