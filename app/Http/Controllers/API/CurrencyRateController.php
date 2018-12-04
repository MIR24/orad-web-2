<?php

namespace App\Http\Controllers\API;

use App\Repositories\CurrencyRateRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class CurrencyRateController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  CurrencyRateRepository  $repository
     * @return void
     */
    public function __construct(CurrencyRateRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_currencyrates']);
        $this->middleware(['permission:create_currencyrates'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_currencyrates'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_currencyrates'])->only(['destroy']);
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

        if ($user->can('update_currencyrates')) {
            $validationRules = [
                'data.val1' => 'required|string|max:255',
                'data.val2' => 'required|string|max:255',
                'data.dir' => 'required|integer',
                'data.value' => 'required|numeric',
            ];
        } else {
            if ($user->can('update_val1_currencyrates')) {
                $validationRules['data.val1'] = 'required|string|max:255';
            }
            if ($user->can('update_val2_currencyrates')) {
                $validationRules['data.val2'] = 'required|string|max:255';
            }
            if ($user->can('update_dir_currencyrates')) {
                $validationRules['data.dir'] = 'required|integer';
            }
            if ($user->can('update_value_currencyrates')) {
                $validationRules['data.value'] = 'required|numeric';
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

        if ($user->can('update_currencyrates')) {
            $validationRules = [
                'data.val1' => 'required|string|max:255',
                'data.val2' => 'required|string|max:255',
                'data.dir' => 'required|integer',
                'data.value' => 'required|numeric',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_val1_currencyrates')) {
                $validationRules['data.val1'] = 'required|string|max:255';
            }
            if ($user->can('update_val2_currencyrates')) {
                $validationRules['data.val2'] = 'required|string|max:255';
            }
            if ($user->can('update_dir_currencyrates')) {
                $validationRules['data.dir'] = 'required|integer';
            }
            if ($user->can('update_value_currencyrates')) {
                $validationRules['data.value'] = 'required|numeric';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
