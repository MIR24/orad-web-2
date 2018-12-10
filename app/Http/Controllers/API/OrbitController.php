<?php

namespace App\Http\Controllers\API;

use App\Repositories\OrbitRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class OrbitController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  OrbitRepository  $repository
     * @return void
     */
    public function __construct(OrbitRepository $repository)
    {
        parent::__construct($repository);

        $this->middleware(['permission:see_orbits']);
        $this->middleware(['permission:create_orbits'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_orbits'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_orbits'])->only(['destroy']);
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

        if ($user->can('update_orbits')) {
            $validationRules = [
                'data.name' => 'required|string|max:255',
            ];
        } else {
            if ($user->can('update_name_orbits')) {
                $validationRules['data.name'] = 'required|string|max:255';
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

        if ($user->can('update_orbits')) {
            $validationRules = [
                'data.name' => 'required|string|max:255',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_name_orbits')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
