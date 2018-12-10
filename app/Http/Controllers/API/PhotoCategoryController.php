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
        parent::__construct($repository);

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
        $user = $request->user();
        $validationRules = [];

        if ($user->can('update_photocategories')) {
            $validationRules = [
                'data.text' => 'required|string|max:255',
            ];
        } else {
            if ($user->can('update_text_photocategories')) {
                $validationRules['data.text'] = 'required|string|max:255';
            }
        }

        $validatedData = $request->validate($validationRules);

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
        $user = $request->user();
        $validationRules = ['data.id' => 'integer'];

        if ($user->can('update_photocategories')) {
            $validationRules = [
                'data.text' => 'required|string|max:255',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_text_photocategories')) {
                $validationRules['data.text'] = 'required|string|max:255';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
