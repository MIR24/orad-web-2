<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
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
    protected $fillable = ['param', 'desc', 'value'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Settings';

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        $func = function ($model) {
            forget_settings_hash();

            config([config('validation-settings')[$model->param] => intval($model->value)+1]);
        };

        static::saved($func);
        static::deleted($func);
        static::restored($func);
    }
}
