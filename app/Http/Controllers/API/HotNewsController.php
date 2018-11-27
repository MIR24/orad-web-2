<?php

namespace App\Http\Controllers\API;

use App\Repositories\HotNewsRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class HotNewsController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  HotNewsRepository  $repository
     * @return void
     */
    public function __construct(HotNewsRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:see_hotnews']);
        $this->middleware(['can:create_hotnews'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_hotnews'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_hotnews'])->only(['destroy']);
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
            'data.text' => 'required|string|max:255',
            'data.strings' => 'required|string',
            'data.deleted_at' => 'date|nullable',
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
            'data.text' => 'required|string|max:255',
            'data.strings' => 'required|string',
            'data.deleted_at' => 'date|nullable',
            'data.id' => 'integer',
        ]);
        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
