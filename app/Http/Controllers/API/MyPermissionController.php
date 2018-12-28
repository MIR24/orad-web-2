<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MyPermissionController extends Controller
{
    /**
     * Display requestors resource permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return app(UserController::class)->showPermissions($request->user()->id);
    }
}
