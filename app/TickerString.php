<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TickerString extends Model
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
    protected $table = 'Tickers';

    /**
     * Get the category for the strings.
     */
    public function category()
    {
        return $this->belongsTo('App\TickerCategory', 'category_id');
    }
}
