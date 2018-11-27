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
        $this->repository = $repository;
        $this->middleware(['can:see_users']);
        $this->middleware(['can:create_users'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_users'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_users'])->only(['destroy']);
    }

    /**
     * Display requestors resource permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showSelfPermissionsSelf(Request $request)
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
