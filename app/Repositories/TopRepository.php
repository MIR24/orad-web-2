<?php

namespace App\Repositories;

use App\Repositories\RepositoryWithStrings;

class TopRepository extends RepositoryWithStrings
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'App\TopCategory';
    }
}
