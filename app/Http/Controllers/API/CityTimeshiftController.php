<?php

namespace App\Http\Controllers\API;

use App\Repositories\CityTimeshiftRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class CityTimeshiftController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  CityTimeshiftRepository  $repository
     * @return void
     */
    public function __construct(CityTimeshiftRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_citytimeshifts']);
        $this->middleware(['permission:create_citytimeshifts'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_citytimeshifts'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_citytimeshifts'])->only(['destroy']);
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

        if ($user->can('update_citytimeshifts')) {
            $validationRules = [
                'data.city' => 'required|string|max:255',
                'data.timeshift' => 'required|integer',
            ];
        } else {
            if ($user->can('update_city_citytimeshifts')) {
                $validationRules['data.city'] = 'required|string|max:255';
            }
            if ($user->can('update_timeshift_citytimeshifts')) {
                $validationRules['data.timeshift'] = 'required|integer';
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

        if ($user->can('update_citytimeshifts')) {
            $validationRules = [
                'data.city' => 'required|string|max:255',
                'data.timeshift' => 'required|integer',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_city_citytimeshifts')) {
                $validationRules['data.city'] = 'required|string|max:255';
            }
            if ($user->can('update_timeshift_citytimeshifts')) {
                $validationRules['data.timeshift'] = 'required|integer';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
