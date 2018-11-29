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
        $validatedData = $request->validate([
            'data.title' => 'required|string|max:255',
            'data.description' => 'required|string',
            'data.happen_at' => 'required|integer',
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
            'data.title' => 'required|string|max:255',
            'data.description' => 'required|string',
            'data.happen_at' => 'required|integer',
            'data.id' => 'integer',
        ]);
        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
