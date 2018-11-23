<?php

namespace App\Traits;

trait Searchable
{
    /**
     * Get the strings for the category.
     *
     * @return array
     */
    public function getSearchableColumns()
    {
        return !empty($this->searchable) ? $this->searchable : [];
    }
}
