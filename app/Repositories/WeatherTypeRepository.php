<?php

namespace App\Repositories;

use App\Repositories\Repository;

class WeatherTypeRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'App\WeatherType';
    }

    /**
     * Destroy the models for the given IDs.
     *
     * @param  array|int  $ids
     * @return array
     */
    public function delete($ids)
    {
        $model = $this->model->findOrFail($ids);

        if ($model->weatherForecastLiners()->exists() || $model->weatherForecasts()->exists()) {
            abort(422, 'Иконка используется');
        }

        return ['model' => $this->model->destroy($ids)];
    }
}
