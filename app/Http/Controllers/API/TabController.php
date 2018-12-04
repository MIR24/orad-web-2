<?php

namespace App\Http\Controllers\API;

use App\Repositories\TabRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class TabController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  TabRepository  $repository
     * @return void
     */
    public function __construct(TabRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_tabs']);
        $this->middleware(['permission:create_tabs'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_tabs'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_tabs'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CommonResource(
            $this->repository->search(
                $request->query()
            )
        );
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

        if ($user->can('update_tabs')) {
            $validationRules = [
                'data.name' => 'required|string|max:255',
                'data.message' => 'required|string|max:255',
                'data.position' => 'required|integer',
            ];
        } else {
            if ($user->can('update_name_tabs')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
            if ($user->can('update_message_tabs')) {
                $validationRules['data.message'] = 'required|string|max:255';
            }
            if ($user->can('update_position_tabs')) {
                $validationRules['data.position'] = 'required|integer';
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

        if ($user->can('update_tabs')) {
            $validationRules = [
                'data.name' => 'required|string|max:255',
                'data.message' => 'required|string|max:255',
                'data.position' => 'required|integer',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_name_tabs')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
            if ($user->can('update_message_tabs')) {
                $validationRules['data.message'] = 'required|string|max:255';
            }
            if ($user->can('update_position_tabs')) {
                $validationRules['data.position'] = 'required|integer';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
