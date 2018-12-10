<?php

namespace App\Http\Controllers\API;

use App\Repositories\NowFurtherLaterRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class NowFurtherLaterController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  NowFurtherLaterRepository  $repository
     * @return void
     */
    public function __construct(NowFurtherLaterRepository $repository)
    {
        parent::__construct($repository);

        $this->middleware(['permission:see_nowfurtherlaters']);
        $this->middleware(['permission:create_nowfurtherlaters'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_nowfurtherlaters'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_nowfurtherlaters'])->only(['destroy']);
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

        if ($user->can('update_nowfurtherlaters')) {
            $validationRules = [
                'data.name' => 'required|string|max:255',
                'data.external_id' => 'required|integer',
                'data.path' => 'required|string|max:255',
            ];
        } else {
            if ($user->can('update_name_nowfurtherlaters')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
            if ($user->can('update_external_id_nowfurtherlaters')) {
                $validationRules['data.category_id'] = 'required|integer';
            }
            if ($user->can('update_path_nowfurtherlaters')) {
                $validationRules['data.path'] = 'required|string|max:255';
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

        if ($user->can('update_nowfurtherlaters')) {
            $validationRules = [
                'data.name' => 'required|string|max:255',
                'data.external_id' => 'required|integer',
                'data.path' => 'required|string|max:255',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_name_nowfurtherlaters')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
            if ($user->can('update_external_id_nowfurtherlaters')) {
                $validationRules['data.category_id'] = 'required|integer';
            }
            if ($user->can('update_path_nowfurtherlaters')) {
                $validationRules['data.path'] = 'required|string|max:255';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
