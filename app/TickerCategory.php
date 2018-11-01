<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CategoryWithStrings;

class TickerCategory extends Model
{
    use SoftDeletes;
    use CategoryWithStrings;

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
    protected $fillable = ['text'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'TickersCategories';

    /**
     * String model name.
     *
     * @var string
     */
    protected $stringModel = 'App\TickerString';
}
