<?php

namespace App\Http\Controllers\API;

use App\Repositories\PhotoCategoryRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

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
        parent::__construct($repository, 'photocategories');
    }
}
