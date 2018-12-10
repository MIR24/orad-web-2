<?php

namespace App\Http\Controllers\API;

use App\Repositories\NewsbarRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;
use App\Setting;

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
        parent::__construct($repository);

        $this->middleware(['permission:see_newsbars']);
        $this->middleware(['permission:create_newsbars'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_newsbars'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_newsbars'])->only(['destroy']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = Setting::where('PARAM', 'NB_BEG_LENGTH')->first();
        $length = $setting->value+1;
        $user = $request->user();
        $validationRules = [];

        if ($user->can('update_newsbars')) {
            $validationRules = [
                'data.text' => 'required|string|max:255',
                'data.strings' => 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu',
            ];
        } else {
            if ($user->can('update_text_newsbars')) {
                $validationRules['data.text'] = 'required|string|max:255';
            }
            if ($user->can('update_strings_newsbars')) {
                $validationRules['data.strings'] = 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu';
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
        $setting = Setting::where('PARAM', 'NB_BEG_LENGTH')->first();
        $length = $setting->value+1;
        $user = $request->user();
        $validationRules = ['data.id' => 'integer'];

        if ($user->can('update_newsbars')) {
            $validationRules = [
                'data.text' => 'required|string|max:255',
                'data.strings' => 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_text_newsbars')) {
                $validationRules['data.text'] = 'required|string|max:255';
            }
            if ($user->can('update_strings_newsbars')) {
                $validationRules['data.strings'] = 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
