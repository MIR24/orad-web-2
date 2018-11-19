<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface Searchable
{
    /**
     * Get the strings for the category.
     *
     * @return array
     */
    public function getSearchableColumns();
}
