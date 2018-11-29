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
        $this->repository = $repository;
        $this->middleware(['permission:see_photocategories']);
        $this->middleware(['permission:create_photocategories'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_photocategories'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_photocategories'])->only(['destroy']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data.text' => 'required|string|max:255',
        ]);
        return new CommonResource($this->repository->create($validatedData['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'data.text' => 'required|string|max:255',
            'data.id' => 'integer',
        ]);
        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
