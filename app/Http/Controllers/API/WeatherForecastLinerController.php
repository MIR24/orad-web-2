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
        $this->middleware(['permission:see_weatherforecastsliners']);
        $this->middleware(['permission:create_weatherforecastsliners'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_weatherforecastsliners'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_weatherforecastsliners'])->only(['destroy']);
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

        if ($user->can('update_weatherforecastsliners')) {
            $validationRules = [
                'data.city' => 'required|string|max:70',
                'data.evening' => 'required|integer',
                'data.morning' => 'required|integer',
                'data.now' => 'required|integer',
                'data.status' => 'required|string|max:70',
                'data.weather_type_id' => 'required|integer'
            ];
        } else {
            if ($user->can('update_status_weatherforecastsliners')) {
                $validationRules['data.status'] = 'required|string|max:70';
            }
            if ($user->can('update_city_weatherforecastsliners')) {
                $validationRules['data.city'] = 'required|string|max:70';
            }
            if ($user->can('update_morning_weatherforecastsliners')) {
                $validationRules['data.morning'] = 'required|integer';
            }
            if ($user->can('update_now_weatherforecastsliners')) {
                $validationRules['data.now'] = 'required|integer';
            }
            if ($user->can('update_evening_weatherforecastsliners')) {
                $validationRules['data.evening'] = 'required|integer';
            }
            if ($user->can('update_weather_type_id_weatherforecastsliners')) {
                $validationRules['data.weather_type_id'] = 'required|integer';
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

        if ($user->can('update_weatherforecastsliners')) {
            $validationRules = [
                'data.city' => 'required|string|max:70',
                'data.evening' => 'required|integer',
                'data.morning' => 'required|integer',
                'data.now' => 'required|integer',
                'data.status' => 'required|string|max:70',
                'data.weather_type_id' => 'required|integer',
                'data.id' => 'integer'
            ];
        } else {
            if ($user->can('update_status_weatherforecastsliners')) {
                $validationRules['data.status'] = 'required|string|max:70';
            }
            if ($user->can('update_city_weatherforecastsliners')) {
                $validationRules['data.city'] = 'required|string|max:70';
            }
            if ($user->can('update_morning_weatherforecastsliners')) {
                $validationRules['data.morning'] = 'required|integer';
            }
            if ($user->can('update_now_weatherforecastsliners')) {
                $validationRules['data.now'] = 'required|integer';
            }
            if ($user->can('update_evening_weatherforecastsliners')) {
                $validationRules['data.evening'] = 'required|integer';
            }
            if ($user->can('update_weather_type_id_weatherforecastsliners')) {
                $validationRules['data.weather_type_id'] = 'required|integer';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
