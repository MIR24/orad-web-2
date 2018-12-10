<?php

namespace App\Http\Controllers\API;

use App\Repositories\HotNewsRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;
use App\Setting;

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
        parent::__construct($repository);

        $this->middleware(['permission:see_hotnews']);
        $this->middleware(['permission:create_hotnews'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_hotnews'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_hotnews'])->only(['destroy']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $setting = Setting::where('PARAM', 'SINGLE_HOT_LENGTH')->first();
        $length = $setting->value+1;
        $user = $request->user();
        $validationRules = [];

        if ($user->can('update_hotnews')) {
            $validationRules = [
                'data.text' => 'required|string|max:255',
                'data.strings' => 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu',
            ];
        } else {
            if ($user->can('update_text_hotnews')) {
                $validationRules['data.text'] = 'required|string|max:255';
            }
            if ($user->can('update_strings_hotnews')) {
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
        $setting = Setting::where('PARAM', 'SINGLE_HOT_LENGTH')->first();
        $length = $setting->value+1;
        $user = $request->user();
        $validationRules = ['data.id' => 'integer'];

        if ($user->can('update_hotnews')) {
            $validationRules = [
                'data.text' => 'required|string|max:255',
                'data.strings' => 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu',
                'data.id' => 'integer',
            ];
        } else {
            if ($user->can('update_text_hotnews')) {
                $validationRules['data.text'] = 'required|string|max:255';
            }
            if ($user->can('update_strings_hotnews')) {
                $validationRules['data.strings'] = 'required|string|regex:'.config('strings.alowed_symbols').'|not_regex:/.{'.$length.',}/mu';
            }
        }

        $validatedData = $request->validate($validationRules);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }
}
