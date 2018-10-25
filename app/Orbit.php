<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orbit extends Model
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
    protected $table = 'Orbit';

    /**
     * The HotNewsCategories that belong to the Orbit.
     */
    public function hotNewsCategories()
    {
        return $this->belongsToMany('App\HotNewsCategory', 'HotNews_Orbit', 'Orbit_id', 'HotNewsCategoriy_id');
    }

    /**
     * Get the strings for the category.
     */
    public function strings()
    {
        return $this->hasMany('App\HotNewsString', 'category_id');
    }
}
