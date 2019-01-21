<?php

namespace App\Repositories;

use App\Repositories\Repository;
use App\Http\Resources\Common as CommonResource;

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
            abort(
                (new CommonResource(['message' => 'Иконка используется.']))
                    ->response()
                    ->setStatusCode(422)
            );
        }

        return ['model' => $this->model->destroy($ids)];
    }
}
