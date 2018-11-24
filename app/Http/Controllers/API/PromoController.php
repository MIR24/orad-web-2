<?php

namespace App\Http\Controllers\API;

use App\Repositories\PromoRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonCollectionResource;
use Illuminate\Http\Request;

class PromoController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  PromoRepository  $repository
     * @return void
     */
    public function __construct(PromoRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:create_promos'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_promos'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_promos'])->only(['destroy']);
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
