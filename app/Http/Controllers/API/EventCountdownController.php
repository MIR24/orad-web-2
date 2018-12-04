<?php

namespace App\Http\Controllers\API;

use App\Repositories\EventCountdownRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class EventCountdownController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  EventCountdownRepository  $repository
     * @return void
     */
    public function __construct(EventCountdownRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_eventcountdowns']);
        $this->middleware(['permission:create_eventcountdowns'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_eventcountdowns'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_eventcountdowns'])->only(['destroy']);
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

        if ($user->can('update_eventcountdowns')) {
            $validationRules = [
                'data.title' => 'required|string|max:255',
                'data.description' => 'required|string',
                'data.happen_at' => 'required|integer',
            ];
        } else {
            if ($user->can('update_title_eventcountdowns')) {
                $validationRules['data.val1'] = 'required|string|max:255';
            }
            if ($user->can('update_description_eventcountdowns')) {
                $validationRules['data.val2'] = 'required|string';
            }
            if ($user->can('update_happen_at_eventcountdowns')) {
                $validationRules['data.dir'] = 'required|integer';
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

        if ($user->can('update_eventcountdowns')) {
            $validationRules = [
                'data.title' => 'required|string|max:255',
                'data.description' => 'required|string',
                'data.happen_at' => 'required|integer',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_title_eventcountdowns')) {
                $validationRules['data.val1'] = 'required|string|max:255';
            }
            if ($user->can('update_description_eventcountdowns')) {
                $validationRules['data.val2'] = 'required|string';
            }
            if ($user->can('update_happen_at_eventcountdowns')) {
                $validationRules['data.dir'] = 'required|integer';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
