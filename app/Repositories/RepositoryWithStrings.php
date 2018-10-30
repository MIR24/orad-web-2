<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Exceptions\RepositoryException;
use App\Repositories\Repository;

abstract class RepositoryWithStrings extends Repository
{
    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all($columns = ['*'])
    {
        return $this->model->allWithStrings($columns);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function create(array $attributes = [])
    {
        return $this->model->createWithStrings($attributes);
    }

    /**
     * Update the model in the database.
     *
     * @param  array  $attributes
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function update(array $attributes, $id)
    {
        $model = $this->model->findOrFail($id);

        $model->updateWithStrings($attributes, $id);

        return $this->findOrFail($id);
    }

    /**
     * Destroy the models for the given IDs.
     *
     * @param  array|int  $ids
     * @return int
     */
    public function delete($ids)
    {
        return $this->model->deleteWithStrings($ids);
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
    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model->findWithStrings($id, $columns);
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
    public function findOrFailWithRelations($id, $columns = ['*'], $relations = [])
    {
        return $this->model->with($relations)->findWithStrings($id, $columns);
    }

    /**
     * Search for the models from the database.
     *
     * @param  array  $columns
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search($query, $columns = [])
    {
        $builder = $this->model->query();

        if (!empty($query[config('search.query.name')])) {
            foreach ($columns as $column) {
                $builder->orWhere($column, 'like', '%'.$query[config('search.query.name')].'%');
            }
        }

        return $builder->get();
    }

    /**
     * Search for the models from the database with relations.
     *
     * @param  array  $query
     * @param  array  $columns
     * @param  array|string  $relations
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchWithRelations($query, $columns = [], $relations = [])
    {
        $builder = $this->model->query();

        $builder->with($relations);

        if (!empty($query[config('search.query.name')])) {
            foreach ($columns as $column) {
                $builder->orWhere($column, 'like', '%'.$query[config('search.query.name')].'%');
            }
        }

        return $builder->get();
    }

    /**
     * Set the relationships that should be eager loaded.
     *
     * @param  mixed  $relations
     * @return Illuminate\\Database\\Eloquent\\Builder
     */
    public function with($relations)
    {
        return $this->model->with($relations);
    }
}
