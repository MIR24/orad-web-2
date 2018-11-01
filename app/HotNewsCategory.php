<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\CategoryWithStrings;
use App\Contracts\CategoryWithStrings as CategoryWithStringsInterface;

class HotNewsCategory extends Model implements CategoryWithStringsInterface
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
    protected $table = 'HotNewsCategories';

    /**
     * String model name.
     *
     * @var string
     */
    protected $stringModel = 'App\HotNewsString';

    /**
     * The Orbits that belong to the HotNewsCategoriy.
     */
    public function orbits()
    {
        return $this->belongsToMany('App\Orbit', 'HotNews_Orbit', 'HotNewsCategoriy_id', 'Orbit_id');
    }
}
