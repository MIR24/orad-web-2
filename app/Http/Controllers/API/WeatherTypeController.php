<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherTypeRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class WeatherTypeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  WeatherTypeRepository  $repository
     * @return void
     */
    public function __construct(WeatherTypeRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_weathertypes']);
        $this->middleware(['permission:create_weathertypes'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_weathertypes'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_weathertypes'])->only(['destroy']);
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

        if ($user->can('update_weathertypes')) {
            $validationRules = [
                'data.type' => 'required|string|max:255',
                'data.icon' => 'required|string|max:255',
            ];
        } else {
            if ($user->can('update_type_weathertypes')) {
                $validationRules['data.status'] = 'required|string|max:70';
            }
            if ($user->can('update_icon_weathertypes')) {
                $validationRules['data.city'] = 'required|string|max:70';
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

        if ($user->can('update_weathertypes')) {
            $validationRules = [
                'data.type' => 'required|string|max:255',
                'data.icon' => 'required|string|max:255',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_type_weathertypes')) {
                $validationRules['data.status'] = 'required|string|max:70';
            }
            if ($user->can('update_icon_weathertypes')) {
                $validationRules['data.city'] = 'required|string|max:70';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
