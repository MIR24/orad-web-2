<?php

namespace App\Http\Controllers\API;

use App\Repositories\PhotoRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonCollectionResource;
use Illuminate\Http\Request;

class PhotoController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  PhotoRepository  $repository
     * @return void
     */
    public function __construct(PhotoRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:create_photos'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_photos'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_photos'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CommonCollectionResource(
            $this->repository->search(
                $request->query()
            )
        );
    }
}
