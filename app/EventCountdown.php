<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class EventCountdown extends Model
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
    protected $fillable = ['title', 'description', 'happen_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'EventCountdowns';

    /**
     * Get the EventCountdown's happen_at.
     *
     * @param  string  $value
     * @return string
     */
    public function getHappenAtAttribute($value)
    {
        return Carbon::createFromTimestamp($value)->toDateTimeString();
    }

    /**
     * Set the EventCountdown's happen_at.
     *
     * @param  string  $value
     * @return void
     */
    public function setHappenAtAttribute($value)
    {
        $this->attributes['happen_at'] = Carbon::parse($value)->timestamp;
    }
}
