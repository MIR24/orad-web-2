<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Common as CommonResource;
use App\Contracts\Repository;

abstract class BaseController extends Controller
{
    /**
     * The resource name.
     */
    protected $resource;

    /**
     * The repository instance.
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @param  Repository  $repository
     * @param  string  $resource
     * @return void
     */
    public function __construct(Repository $repository, string $resource)
    {
        $this->repository = $repository;
        $this->resource = $resource;

        $this->middleware(['log_everything']);
        $this->middleware(['permission:see_'.$this->resource]);
        $this->middleware(['permission:create_'.$this->resource])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_'.$this->resource])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_'.$this->resource])->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CommonResource($this->repository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $this->validateResource($request);

        return new CommonResource($this->repository->create($validatedData['data']));
    }

    /**
     * Creates or Updates one or more items in specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function patchMultiple(Request $request)
    {
        $validatedData = $this->validateResource($request, true, true);

        return new CommonResource($this->repository->patchMultiple($validatedData['data']));
    }

    /**
     * Store multiple newly created resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMultiple(Request $request)
    {
        $validatedData = $this->validateResource($request, false, true);

        return new CommonResource($this->repository->createMultiple($validatedData['data']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return new CommonResource($this->repository->findOrFail($id));
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
        $validatedData = $this->validateResource($request, true);

        return new CommonResource($this->repository->update($validatedData['data'], $id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return new CommonResource($this->repository->delete($id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool $withId
     * @param  bool $multiple
     * @return array
     */
    public function validateResource(Request $request, bool $withId = false, bool $multiple = false): array
    {
        if (empty($this->resource)) {
            throw new Exception('Resource name is empty.');
        }

        $user = $request->user();
        $validationRules = $withId ? ['data.id' => 'required|integer'] : [];
        $config = config('validation.'.$this->resource);

        if ($multiple) {
            $config['prefix'] .= '*.';
        }

        if ($user->can('update_'.$this->resource)) {
            foreach ($config['fields'] as $field => $rule) {
                $validationRules[$config['prefix'].$field] = $rule;
            }
            if ($withId) {
                $validationRules['data.id'] = 'required|integer';
            }
        } else {
            foreach ($config['fields'] as $field => $rule) {
                if ($user->can('update_'.$field.'_'.$this->resource)) {
                    $validationRules[$config['prefix'].$field] = $rule;
                }
            }
        }

        return $request->validate($validationRules);
    }
}
