<?php

namespace App\Repositories;

use App\Repositories\Repository;

class CityTimeshiftRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'App\CityTimeshift';
    }
}
