<?php

namespace App\Http\Controllers\API;

use App\Repositories\UserRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;

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
