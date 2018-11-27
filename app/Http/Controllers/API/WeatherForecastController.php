<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherForecastRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class WeatherForecastController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  WeatherForecastRepository  $repository
     * @return void
     */
    public function __construct(WeatherForecastRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:see_weatherforecasts']);
        $this->middleware(['can:create_weatherforecasts'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_weatherforecasts'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_weatherforecasts'])->only(['destroy']);
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
            'data.city' => 'required|string|max:70',
            'data.evening' => 'required|integer',
            'data.morning' => 'required|integer',
            'data.status' => 'required|string|max:70',
            'data.weather_type_id' => 'required|integer',
            'data.deleted_at' => 'date|nullable',
        ]);
        if (!$request->user()->can('edit_status_weatherforecasts')) {
            unset($validatedData['data']['status']);
        }
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
            'data.city' => 'required|string|max:70',
            'data.evening' => 'required|integer',
            'data.morning' => 'required|integer',
            'data.status' => 'required|string|max:70',
            'data.weather_type_id' => 'required|integer',
            'data.deleted_at' => 'date|nullable',
            'data.id' => 'integer',
        ]);
        if (!$request->user()->can('edit_status_weatherforecasts')) {
            unset($validatedData['data']['status']);
        }
        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
