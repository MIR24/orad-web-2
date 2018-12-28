<?php

namespace App\Http\Controllers\API;

use App\Repositories\CurrencyRateRepository;
use App\Http\Controllers\API\BaseController;
use App\Http\Resources\Common as CommonResource;
use Illuminate\Http\Request;

class CurrencyRateController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @param  CurrencyRateRepository  $repository
     * @return void
     */
    public function __construct(CurrencyRateRepository $repository)
    {
        parent::__construct($repository, 'currencyrates');
    }
}
