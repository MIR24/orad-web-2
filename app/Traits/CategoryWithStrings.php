<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Carbon\Carbon;

trait CategoryWithStrings
{
    /**
     * Get the strings for the category.
     */
    public function strings()
    {
        return $this->hasMany($this->stringModel, 'category_id');
    }

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        static::deleting(function ($model) {
             $model->strings()->delete();
        });
    }
}
