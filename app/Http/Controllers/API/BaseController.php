<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Common as CommonResource;
use App\Http\Resources\Common as CommonCollectionResource;
use App\Contracts\Repository;

abstract class BaseController extends Controller
{
    /**
     * The repository instance.
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @param  Repository  $repository
     * @return void
     */
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CommonCollectionResource($this->repository->all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new CommonResource($this->repository->create($request->input('data')));
    }

    /**
     * Creates or Updates one or more items in specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function patchMultiple(Request $request)
    {
        return new CommonCollectionResource($this->repository->patchMultiple($request->input('data')));
    }

    /**
     * Store multiple newly created resources in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMultiple(Request $request)
    {
        return new CommonCollectionResource($this->repository->createMultiple($request->input('data')));
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
        $result = $this->repository->update($request->input('data'), intval($id));

        if (is_numeric($id)) {
            return new CommonResource($result);
        } else {
            return new CommonCollectionResource($result);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return new CommonResource(['model' => $this->repository->delete($id)]);
    }
}
