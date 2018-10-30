<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NewsbarCategory extends Model
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
    protected $table = 'NewsbarsCategories';

    /**
     * Get the strings for the category.
     */
    public function strings()
    {
        return $this->hasMany('App\NewsbarString', 'category_id');
    }
}
