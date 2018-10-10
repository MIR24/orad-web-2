<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopCategory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'TopsCategories';

    /**
     * Get the comments for the blog post.
     */
    public function topStrings()
    {
        return $this->hasMany('App\TopString', 'category_id');
    }
}
