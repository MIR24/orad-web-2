<?php

namespace App\Repositories;

use App\Repositories\Repository;

class NewsbarRepository extends RepositoryWithStrings
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'App\NewsbarCategory';
    }
}
