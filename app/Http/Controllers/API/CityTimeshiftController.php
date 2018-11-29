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
        $validatedData = $request->validate([
            'data.city' => 'required|string|max:255',
            'data.timeshift' => 'required|integer',
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
            'data.city' => 'required|string|max:255',
            'data.timeshift' => 'required|integer',
            'data.id' => 'integer',
        ]);
        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
