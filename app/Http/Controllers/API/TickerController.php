<?php

namespace App\Http\Controllers\API;

use App\Repositories\TickerRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;
use App\Setting;

class TickerController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  TickerRepository  $repository
     * @return void
     */
    public function __construct(TickerRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware(['permission:see_tickers']);
        $this->middleware(['permission:create_tickers'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_tickers'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_tickers'])->only(['destroy']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = Setting::where('PARAM', 'NB_TOP_LENGTH')->first();
        $length = $setting->value+1;

        $validatedData = $request->validate([
            'data.text' => 'required|string|max:255',
            'data.strings' => 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu',
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
        $setting = Setting::where('PARAM', 'NB_TOP_LENGTH')->first();
        $length = $setting->value+1;

        $validatedData = $request->validate([
            'data.text' => 'required|string|max:255',
            'data.strings' => 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu',
            'data.id' => 'integer',
        ]);
        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
