<?php

namespace App\Http\Controllers\API;

use App\Repositories\PromoCategoryRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

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
        parent::__construct($repository, 'promocategories');
    }
}
