<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Traits\Searchable;
use App\Contracts\Searchable as SearchableInterface;

class Promo extends Model implements SearchableInterface
{
    use SoftDeletes;
    use Searchable;

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
    protected $fillable = ['mir_id', 'mirhd_id', 'age', 'name', 'header', 'subheader', 'mode', 'category_id'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Promos';

    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['name', 'header', 'subheader', 'age'];

    /**
     * Get the category for the strings.
     */
    public function category()
    {
        return $this->belongsTo('App\PromoCategory', 'category_id');
    }
}
