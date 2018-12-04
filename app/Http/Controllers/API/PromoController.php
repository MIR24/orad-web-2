<?php

namespace App\Http\Controllers\API;

use App\Repositories\PromoRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonCollectionResource;
use Illuminate\Http\Request;

class PromoController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  PromoRepository  $repository
     * @return void
     */
    public function __construct(PromoRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:create_promos'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_promos'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_promos'])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CommonCollectionResource(
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

        if ($user->can('update_promos')) {
            $validationRules = [
                'data.mir_id' => 'required|integer',
                'data.mirhd_id' => 'required|integer',
                'data.category_id' => 'required|integer',
                'data.age' => 'required|integer',
                'data.name' => 'required|string|max:255',
                'data.header' => 'required|string|max:255',
                'data.subheader' => 'required|string|max:255',
                'data.mode' => 'required|integer',
            ];
        } else {
            if ($user->can('update_mir_id_promos')) {
                $validationRules['data.mir_id'] = 'required|integer';
            }
            if ($user->can('update_mirhd_id_promos')) {
                $validationRules['data.mirhd_id'] = 'required|integer';
            }
            if ($user->can('update_category_id_promos')) {
                $validationRules['data.category_id'] = 'required|integer';
            }
            if ($user->can('update_age_promos')) {
                $validationRules['data.age'] = 'required|integer';
            }
            if ($user->can('update_name_promos')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
            if ($user->can('update_header_promos')) {
                $validationRules['data.header'] = 'required|string|max:255';
            }
            if ($user->can('update_subheader_promos')) {
                $validationRules['data.subheader'] = 'required|string|max:255';
            }
            if ($user->can('update_mode_promos')) {
                $validationRules['data.mode'] = 'required|integer';
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

        if ($user->can('update_promos')) {
            $validationRules = [
                'data.mir_id' => 'required|integer',
                'data.mirhd_id' => 'required|integer',
                'data.category_id' => 'required|integer',
                'data.age' => 'required|integer',
                'data.name' => 'required|string|max:255',
                'data.header' => 'required|string|max:255',
                'data.subheader' => 'required|string|max:255',
                'data.mode' => 'required|integer',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_mir_id_promos')) {
                $validationRules['data.mir_id'] = 'required|integer';
            }
            if ($user->can('update_mirhd_id_promos')) {
                $validationRules['data.mirhd_id'] = 'required|integer';
            }
            if ($user->can('update_category_id_promos')) {
                $validationRules['data.category_id'] = 'required|integer';
            }
            if ($user->can('update_age_promos')) {
                $validationRules['data.age'] = 'required|integer';
            }
            if ($user->can('update_name_promos')) {
                $validationRules['data.name'] = 'required|string|max:255';
            }
            if ($user->can('update_header_promos')) {
                $validationRules['data.header'] = 'required|string|max:255';
            }
            if ($user->can('update_subheader_promos')) {
                $validationRules['data.subheader'] = 'required|string|max:255';
            }
            if ($user->can('update_mode_promos')) {
                $validationRules['data.mode'] = 'required|integer';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
