<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopString extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Tops';

    /**
     * Get the comments for the blog post.
     */
    public function topCategory()
    {
        return $this->belongsTo('App\TopCategory', 'category_id');
    }
}
