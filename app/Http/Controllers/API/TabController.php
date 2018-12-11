<?php

namespace App\Http\Controllers\API;

use App\Repositories\TabRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class TabController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  TabRepository  $repository
     * @return void
     */
    public function __construct(TabRepository $repository)
    {
        parent::__construct($repository, 'tabs');
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return new CommonResource(
            $this->repository->search(
                $request->query()
            )
        );
    }
}
