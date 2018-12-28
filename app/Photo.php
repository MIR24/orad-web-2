<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Traits\Searchable;
use App\Contracts\Searchable as SearchableInterface;

class Photo extends Model implements SearchableInterface
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
    protected $fillable = ['name', 'title', 'path'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Photos';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'Id';

    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['Name', 'Title'];

    /**
     * Get the category for the strings.
     */
    public function category()
    {
        return $this->belongsTo('App\PhotoCategory', 'Category_id', 'Id');
    }
}
