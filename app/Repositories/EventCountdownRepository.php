<?php

namespace App\Repositories;

use App\Repositories\Repository;

class EventCountdownRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'App\EventCountdown';
    }
}
