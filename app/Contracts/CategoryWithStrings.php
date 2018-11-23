<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface CategoryWithStrings
{
    /**
     * Get the strings for the category.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function strings();
}
