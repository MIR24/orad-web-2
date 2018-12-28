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
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'icon'];

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

    /**
     * Get the forecasts for the weather type.
     */
    public function weatherForecastLiners()
    {
        return $this->hasMany('App\WeatherForecastLiner', 'weather_type_id');
    }
}
