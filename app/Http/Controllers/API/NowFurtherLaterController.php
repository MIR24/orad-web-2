<?php

namespace App\Http\Controllers\API;

use App\Repositories\NowFurtherLaterRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class NowFurtherLaterController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  NowFurtherLaterRepository  $repository
     * @return void
     */
    public function __construct(NowFurtherLaterRepository $repository)
    {
        parent::__construct($repository, 'nowfurtherlaters');
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
