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
     * Get all of the categories from the database with converted strings.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function allWithStrings($columns = ['*'])
    {
        $models = (new static)::all($columns);
        foreach ($models as $model) {
            $strings = $model->strings()->get();
            $model->strings = $strings->implode('text', config('strings.eol_symbol'));
        }
        return $models;
    }

    /**
     * Find a category by its primary key with converted strings.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static[]|static|null
     */
    public static function findWithStrings($id, $columns = ['*'])
    {
        $model = (new static)::findOrFail($id, $columns);
        $model->strings = $model->strings()->get()->implode('text', config('strings.eol_symbol'));

        return $model;
    }

    /**
     * Delete a category with related strings from the database.
     *
     * @param  mixed  $id
     * @return mixed
     */
    public static function deleteWithStrings($id)
    {
        $model = (new static)::findOrFail($id);

        $result = [];

        $result['strings'] = $model->strings()->delete();
        $result['model'] = $model->delete();

        return $result;
    }

    /**
     * Save a new category with strings.
     *
     * @param  array  $attributes
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public static function updateWithStrings(array $attributes, $id)
    {
        $model = (new static)::with('strings')->findOrFail($id);

        $strings = explode(config('strings.eol_symbol'), $attributes['strings']);

        foreach ($model->strings as $key => $oldString) {
            if (!empty($strings[$key])) {
                $oldString->text = $strings[$key];
                unset($strings[$key]);
            } else {
                $oldString->deleted_at = Carbon::now();
            }
        }
        $convertedStrings = [];

        foreach ($strings as $string) {
            $convertedStrings[] = ['text' => $string];
        }

        $model->fill($attributes);
        $model->push();

        $model->strings()->createMany($convertedStrings);

        return (new static)::findWithStrings($model->id);
    }

    /**
     * Save a new category with strings.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public static function createWithStrings(array $attributes = [])
    {
        $model = (new static)::create($attributes);
        $strings = explode(config('strings.eol_symbol'), $attributes['strings']);
        $convertedStrings = [];

        foreach ($strings as $string) {
            $convertedStrings[] = ['text' => $string];
        }

        $newStrings = $model->strings()->createMany($convertedStrings);

        return (new static)::findWithStrings($model->id);
    }
}
