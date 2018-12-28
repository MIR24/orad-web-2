<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Searchable;
use App\Contracts\Searchable as SearchableInterface;

class NowFurtherLater extends Model implements SearchableInterface
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
    protected $fillable = ['external_id', 'name', 'path'];

    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['external_id', 'name'];
}
