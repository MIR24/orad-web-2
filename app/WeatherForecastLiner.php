<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WeatherForecastLiner extends Model
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
    protected $fillable = ['status', 'city', 'morning', 'now', 'evening', 'weather_type_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'WeatherForecastsLiner';

    /**
     * Get the weather type for the forecast.
     */
    public function weatherType()
    {
        return $this->belongsTo('App\WeatherType', 'weather_type_id');
    }
}
