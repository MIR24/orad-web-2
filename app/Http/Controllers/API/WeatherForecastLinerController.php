<?php

namespace App\Http\Controllers\API;

use App\Repositories\WeatherForecastLinerRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class WeatherForecastLinerController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  WeatherForecastLinerRepository  $repository
     * @return void
     */
    public function __construct(WeatherForecastLinerRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:see_weatherforecastliners']);
        $this->middleware(['can:create_weatherforecastliners'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_weatherforecastliners'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_weatherforecastliners'])->only(['destroy']);
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
            'data.now' => 'required|integer',
            'data.status' => 'required|string|max:70',
            'data.weather_type_id' => 'required|integer',
            'data.deleted_at' => 'date|nullable',
        ]);
        if (!$request->user()->can('edit_status_weatherforecastsliners')) {
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
            'data.now' => 'required|integer',
            'data.status' => 'required|string|max:70',
            'data.weather_type_id' => 'required|integer',
            'data.deleted_at' => 'date|nullable',
            'data.id' => 'integer',
        ]);
        if (!$request->user()->can('edit_status_weatherforecastsliners')) {
            unset($validatedData['data']['status']);
        }
        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
