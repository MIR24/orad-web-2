<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Exceptions\RepositoryException;
use App\Repositories\Repository;
use Carbon\Carbon;

abstract class RepositoryWithStrings extends Repository
{
    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return load_strings(parent::all($columns));
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function create(array $attributes = [])
    {
        $model = $this->model->create($attributes);
        $strings = explode(config('strings.eol_symbol'), $attributes['strings']);
        $convertedStrings = [];

        foreach ($strings as $string) {
            $convertedStrings[] = ['text' => $string];
        }

        $newStrings = $model->strings()->createMany($convertedStrings);

        return $this->findOrFail($model->id);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function update(array $attributes, int $id)
    {
        $model = $this->model->findOrFail($id);

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

        return $this->findOrFail($model->id);
    }

    /**
     * Find a model by its primary key or throw an exception.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFail($id, array $columns = ['*'])
    {
        return load_strings(parent::findOrFail($id, $columns));
    }

    /**
     * Find a model with relations by its primary key or throw an exception.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @param  array|string  $relations
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection|static|static[]
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function findOrFailWithRelations($id, array $columns = ['*'], $relations = [])
    {
        return load_strings(parent::findOrFailWithRelations($id, $columns, $relations));
    }
}
