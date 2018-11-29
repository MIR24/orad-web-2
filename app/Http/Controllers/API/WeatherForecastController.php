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
        $this->middleware(['permission:see_weatherforecasts']);
        $this->middleware(['permission:create_weatherforecasts'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_weatherforecasts|update_status_weatherforecasts|update_city_weatherforecasts|update_morning_weatherforecasts|update_evening_weatherforecasts|update_weather_type_id_weatherforecasts'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_weatherforecasts'])->only(['destroy']);
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

        if ($user->can('update_weatherforecasts')) {
            $validationRules = [
                'data.city' => 'required|string|max:70',
                'data.evening' => 'required|integer',
                'data.morning' => 'required|integer',
                'data.status' => 'required|string|max:70',
                'data.weather_type_id' => 'required|integer'
            ];
        } else {
            if ($user->can('update_status_weatherforecasts')) {
                $validationRules['data.status'] = 'required|string|max:70';
            }
            if ($user->can('update_city_weatherforecasts')) {
                $validationRules['data.city'] = 'required|string|max:70';
            }
            if ($user->can('update_morning_weatherforecasts')) {
                $validationRules['data.morning'] = 'required|integer';
            }
            if ($user->can('update_evening_weatherforecasts')) {
                $validationRules['data.evening'] = 'required|integer';
            }
            if ($user->can('update_weather_type_id_weatherforecasts')) {
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

        if ($user->can('update_weatherforecasts')) {
            $validationRules = [
                'data.city' => 'required|string|max:70',
                'data.evening' => 'required|integer',
                'data.morning' => 'required|integer',
                'data.status' => 'required|string|max:70',
                'data.weather_type_id' => 'required|integer',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_status_weatherforecasts')) {
                $validationRules['data.status'] = 'required|string|max:70';
            }
            if ($user->can('update_city_weatherforecasts')) {
                $validationRules['data.city'] = 'required|string|max:70';
            }
            if ($user->can('update_morning_weatherforecasts')) {
                $validationRules['data.morning'] = 'required|integer';
            }
            if ($user->can('update_evening_weatherforecasts')) {
                $validationRules['data.evening'] = 'required|integer';
            }
            if ($user->can('update_weather_type_id_weatherforecasts')) {
                $validationRules['data.weather_type_id'] = 'required|integer';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
