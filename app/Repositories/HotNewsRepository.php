<?php

namespace App\Repositories;

use App\Repositories\RepositoryWithStrings;

class HotNewsRepository extends RepositoryWithStrings
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'App\HotNewsCategory';
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
        return parent::findOrFail($id, $columns)->load('orbits');
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
        return parent::findOrFailWithRelations($id, $columns, $relations)->load('orbits');
    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return parent::all($columns)->load('orbits');
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
        $strings = explode(config('strings.eol_symbol'), mb_strtoupper($attributes['strings']));
        $convertedStrings = [];

        foreach ($strings as $string) {
            $convertedStrings[] = ['text' => $string];
        }

        $newStrings = $model->strings()->createMany($convertedStrings);

        if (isset($attributes['orbits'])) {
            $model->orbits()->sync($this->convertManyToMany($attributes['orbits']));
        }

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

        $strings = explode(config('strings.eol_symbol'), mb_strtoupper($attributes['strings']));

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

        if (isset($attributes['orbits'])) {
            $model->orbits()->sync($this->convertManyToMany($attributes['orbits']));
        }

        return $this->findOrFail($model->id);
    }

    /**
     * Convert input relations to array of ids.
     *
     * @param  array $related
     * @return array
     */
    protected function convertManyToMany(array $related): array
    {
        $newRelated = [];

        foreach ($related as $value) {
            if (is_int($value)) {
                $newRelated[] = $value;
                continue;
            }
            if (is_array($value) && is_int($value['id'])) {
                $newRelated[] = $value['id'];
            }
        }

        return $newRelated;
    }
}
