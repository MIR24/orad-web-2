<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HotNewsCategory extends Model
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
    protected $table = 'HotNewsCategories';

    /**
     * Get the strings for the category.
     */
    public function strings()
    {
        return $this->hasMany('App\HotNewsString', 'category_id');
    }

    /**
     * The Orbits that belong to the HotNewsCategoriy.
     */
    public function orbits()
    {
        return $this->belongsToMany('App\Orbit', 'HotNews_Orbit', 'HotNewsCategoriy_id', 'Orbit_id');
    }
}
