<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface CategoryWithStrings
{
    /**
     * Get all of the categories from the database with converted strings.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function allWithStrings($columns = ['*']);

    /**
     * Find a category by its primary key with converted strings.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public static function findWithStrings($id, $columns = ['*']);

    /**
     * Delete a category with related strings from the database.
     *
     * @param  mixed  $id
     * @return mixed
     */
    public static function deleteWithStrings($id);

    /**
     * Save a new category with strings.
     *
     * @param  array  $attributes
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public static function updateWithStrings(array $attributes, $id);

    /**
     * Save a new category with strings.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public static function createWithStrings(array $attributes = []);
}
