<?php

namespace App\Http\Controllers\API;

use App\Repositories\NewsbarRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class NewsbarController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  NewsbarRepository  $repository
     * @return void
     */
    public function __construct(NewsbarRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['can:see_newsbars']);
        $this->middleware(['can:create_newsbars'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_newsbars'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_newsbars'])->only(['destroy']);
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
