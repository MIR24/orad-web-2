<?php

namespace App\Http\Controllers\API;

use App\Repositories\PhotoRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
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
        $this->middleware(['permission:see_photos']);
        $this->middleware(['permission:create_photos'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_photos'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_photos'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CommonResource(
            $this->repository->search(
                $request->query()
            )
        );
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

        if ($user->can('update_photos')) {
            $validationRules = [
                'data.name' => 'required|string|max:255',
                'data.title' => 'required|string|max:255',
                'data.category_id' => 'required|integer',
                'data.path' => 'required|string|max:17',
            ];
        } else {
            if ($user->can('update_name_photos')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
            if ($user->can('update_title_photos')) {
                $validationRules['data.title'] = 'required|string|max:255';
            }
            if ($user->can('update_category_id_photos')) {
                $validationRules['data.category_id'] = 'required|integer';
            }
            if ($user->can('update_path_photos')) {
                $validationRules['data.path'] = 'required|string|max:17';
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

        if ($user->can('update_photos')) {
            $validationRules = [
                'data.name' => 'required|string|max:255',
                'data.title' => 'required|string|max:255',
                'data.category_id' => 'required|integer',
                'data.path' => 'required|string|max:17',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_name_photos')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
            if ($user->can('update_title_photos')) {
                $validationRules['data.title'] = 'required|string|max:255';
            }
            if ($user->can('update_category_id_photos')) {
                $validationRules['data.category_id'] = 'required|integer';
            }
            if ($user->can('update_path_photos')) {
                $validationRules['data.path'] = 'required|string|max:17';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
