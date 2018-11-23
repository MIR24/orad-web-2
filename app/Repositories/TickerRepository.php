<?php

namespace App\Repositories;

use App\Repositories\RepositoryWithStrings;

class TickerRepository extends RepositoryWithStrings
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'App\TickerCategory';
    }
}
