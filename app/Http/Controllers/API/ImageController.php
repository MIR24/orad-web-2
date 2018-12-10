<?php

namespace App\Http\Controllers\API;

use App\Repositories\ImageRepository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * The repository instance.
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @param  ImageRepository  $repository
     * @return void
     */
    public function __construct(ImageRepository $repository)
    {
        $this->repository = $repository;

        $this->middleware(['log_everything']);
        $this->middleware(['permission:create_images'])->only(['store']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image',
            'name' => 'string|max:255',
        ]);

        return new CommonResource($this->repository->create($validatedData));
    }
}
