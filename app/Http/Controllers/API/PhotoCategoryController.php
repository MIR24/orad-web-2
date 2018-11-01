<?php

namespace App\Http\Controllers\API;

use App\Repositories\PhotoCategoryRepository;
use App\Http\Controllers\API\BaseController;

class PhotoCategoryController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $users
     * @return void
     */
    public function __construct(PhotoCategoryRepository $repository)
    {
        $this->repository = $repository;
    }
}
