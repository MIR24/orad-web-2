<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\Searchable;
use App\Contracts\Searchable as SearchableInterface;

class Tab extends Model implements SearchableInterface
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
    protected $fillable = ['name', 'message'];

    /**
     * Searchable columns.
     *
     * @var array
     */
    protected $searchable = ['jsClass'];
}
