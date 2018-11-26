<?php

namespace App\Http\Controllers\API;

use App\Repositories\CurrencyRateRepository;
use App\Http\Controllers\API\BaseController;

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
        $this->repository = $repository;
        $this->middleware(['can:create_currencyrates'])->only(['store', 'storeMultiple']);
        $this->middleware(['can:update_currencyrates'])->only(['update', 'patchMultiple']);
        $this->middleware(['can:delete_currencyrates'])->only(['destroy']);
    }
}
