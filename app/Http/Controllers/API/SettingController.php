<?php

namespace App\Http\Controllers\API;

use App\Repositories\SettingRepository;
use App\Http\Controllers\API\BaseController;

class SettingController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  SettingRepository  $repository
     * @return void
     */
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_settings']);
        $this->middleware(['permission:create_settings'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_settings'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_settings'])->only(['destroy']);
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

        if ($user->can('update_settings')) {
            $validationRules = [
                'data.param' => 'required|string|max:255',
                'data.desc' => 'required|string|max:255',
                'data.value' => 'required|string|max:255',
            ];
        } else {
            if ($user->can('update_param_settings')) {
                $validationRules['data.param'] = 'required|string|max:255';
            }
            if ($user->can('update_desc_settings')) {
                $validationRules['data.desc'] = 'required|string|max:255';
            }
            if ($user->can('update_value_settings')) {
                $validationRules['data.value'] = 'required|string|max:255';
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

        if ($user->can('update_settings')) {
            $validationRules = [
                'data.param' => 'required|string|max:255',
                'data.desc' => 'required|string|max:255',
                'data.value' => 'required|string|max:255',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_param_settings')) {
                $validationRules['data.param'] = 'required|string|max:255';
            }
            if ($user->can('update_desc_settings')) {
                $validationRules['data.desc'] = 'required|string|max:255';
            }
            if ($user->can('update_value_settings')) {
                $validationRules['data.value'] = 'required|string|max:255';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
