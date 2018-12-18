<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Common as CommonResource;
use App\Contracts\Repository;
use Validator;
use \Illuminate\Validation\ValidationException;

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

        $this->registerActionPermissions();
    }

    /**
     * Register actions access permissions.
     *
     * @return void
     */
    protected function registerActionPermissions()
    {
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
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validateResource(Request $request, bool $withId = false, bool $multiple = false): array
    {
        if (empty($this->resource)) {
            throw new Exception('Resource name is empty.');
        }

        $user = $request->user();
        $config = config('validation.'.$this->resource);

        if ($multiple) {
            $config['prefix'] .= '*.';
        }

        if (isset($config['fields']['strings'])) {
            $config['fields']['strings'] = preg_replace_callback(
                "/{%.*?%}/",
                function ($m) {
                    if (!empty($m[0])) {
                        return config(trim($m[0], "{%}"));
                    }
                },
                $config['fields']['strings']
            );
        }

        $validationRules = $withId ? [$config['prefix'].'id' => 'required|integer'] : [];

        if ($user->can('update_'.$this->resource)) {
            foreach ($config['fields'] as $field => $rule) {
                $validationRules[$config['prefix'].$field] = $rule;
            }
        } else {
            foreach ($config['fields'] as $field => $rule) {
                if ($user->can('update_'.$field.'_'.$this->resource)) {
                    $validationRules[$config['prefix'].$field] = $rule;
                }
            }
        }

        $validator = Validator::make($request->all(), $validationRules);

        if ($validator->fails()) {
            throw new ValidationException(
                $validator,
                (new CommonResource([
                    'message' => 'The given data was invalid.',
                    'errors' => $validator->errors()->messages(),
                ]))->response()->setStatusCode(422)
            );
        }

        return $validator->getData();
    }
}
