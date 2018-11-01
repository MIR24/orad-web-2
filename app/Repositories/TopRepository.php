<?php

namespace App\Repositories;

use App\Repositories\Repository;

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
