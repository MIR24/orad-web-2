<?php

namespace App\Http\Controllers\API;

use App\Repositories\PhotoCategoryRepository;
use App\Http\Controllers\API\BaseController;

class PhotoCategoryController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  PhotoCategoryRepository  $repository
     * @return void
     */
    public function __construct(PhotoCategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:create_photocategories'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_photocategories'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_photocategories'])->only(['destroy']);
    }
}
