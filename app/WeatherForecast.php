<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CommonModel;

class WeatherForecast extends Model
{
    use SoftDeletes;
    use CommonModel {
        updateModel as traitUpdateModel;
    }

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
    protected $table = 'WeatherForecasts';

    /**
     * Get the weather type for the forecast.
     */
    public function weatherType()
    {
        return $this->belongsTo('App\WeatherType', 'weather_type_id');
    }

    /**
     * Update the model in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function updateModel(Request $request, $id)
    {
        $model = (new static)::traitUpdateModel($request, $id);

        if (!empty($model)) {
            $model->load('weatherType');
        }

        return $models;
    }
}
