<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PromoCategory extends Model
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
    protected $fillable = ['text'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'PromosCategories';

    /**
     * Get the strings for the category.
     */
    public function promos()
    {
        return $this->hasMany('App\Promo', 'category_id');
    }
}
