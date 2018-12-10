<?php

namespace App\Http\Controllers\API;

use App\Repositories\UserRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  UserRepository  $repository
     * @return void
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);

        $this->middleware(['permission:see_users'])->except(['showSelfPermissions']);
        $this->middleware(['permission:create_users'])->only(['store', 'storeMultiple']);
        $this->middleware(['permission:update_users'])->only(['update', 'patchMultiple']);
        $this->middleware(['permission:delete_users'])->only(['destroy']);
    }

    /**
     * Display requestors resource permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showSelfPermissions(Request $request)
    {
        return $this->showPermissions($request->user()->id);
    }

    /**
     * Display the specified resource permissions.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPermissions(int $id)
    {
        return new CommonResource($this->repository->getPermissions($id));
    }
}
