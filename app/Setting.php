<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CommonModel;

class Setting extends Model
{
    use SoftDeletes;
    use CommonModel;

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
}
