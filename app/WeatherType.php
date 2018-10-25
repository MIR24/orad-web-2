<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherType extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'WeatherTypes';

    /**
     * Get the forecasts for the weather type.
     */
    public function weatherForecasts()
    {
        return $this->hasMany('App\WeatherForecast', 'weather_type_id');
    }
}
