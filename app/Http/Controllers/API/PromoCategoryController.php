<?php

namespace App\Http\Controllers\API;

use App\Repositories\PromoCategoryRepository;
use App\Http\Controllers\API\BaseController;

class PromoCategoryController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  PromoCategoryRepository  $repository
     * @return void
     */
    public function __construct(PromoCategoryRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:create_promocategories'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_promocategories'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_promocategories'])->only(['destroy']);
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

        if ($user->can('update_promocategories')) {
            $validationRules = [
                'data.text' => 'required|string|max:255',
            ];
        } else {
            if ($user->can('update_text_promocategories')) {
                $validationRules['data.text'] = 'required|string|max:255';
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

        if ($user->can('update_promocategories')) {
            $validationRules = [
                'data.text' => 'required|string|max:255',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_text_promocategories')) {
                $validationRules['data.text'] = 'required|string|max:255';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
