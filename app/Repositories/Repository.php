<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use App\Exceptions\RepositoryException;
use App\Contracts\Repository as RepositoryInterface;

abstract class Repository implements RepositoryInterface
{
    /**
     * Application instance.
     */
    private $app;

    /**
     * Model property on class instances.
     */
    protected $model;

    /**
     * Builder property on class instances.
     */
    protected $builder;

    /**
     * Constructor to bind model to repository.
     *
     * @param App $app
     * @throws \Bosnadev\Repositories\Exceptions\RepositoryException
     */
    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
        $this->makeBuilder();
    }

    /**
     * Specify Model class name.
     *
     * @return string
     */
    abstract protected function model();

    /**
     * @return Model
     * @throws RepositoryException
     */
    protected function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * @return Builder
     * @throws RepositoryException
     */
    protected function makeBuilder()
    {
        if (!$this->model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->builder = $this->model->query()->take(config('database.query.limit'));
    }

    /**
     * Get all of the models from the database.
     *
     * @param  array|mixed  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function all(array $columns = ['*'])
    {
        return $this->builder->get($columns);
    }

    /**
     * Get multiple models from the database.
     *
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function get(array $query, array $columns = ['*'])
    {
        $this->checkURLQuery($query);

        return $this->builder->get($columns);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param  array  $attributes
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function create(array $attributes = [])
    {
        return $this->model->create($attributes);
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

        $model->update($attributes);

        return $this->findOrFail($id);
    }

    /**
     * Create multiple models and return the instances.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function createMultiple(array $models = [])
    {
        $result = [];

        foreach ($models as $attributes) {
            $result[] = $this->create($attributes);
        }

        return collect($result);
    }

    /**
     * Update or Create multiple models in the database.
     *
     * @param  array  $models
     * @return \Illuminate\Database\Eloquent\Model|$this
     */
    public function patchMultiple(array $models)
    {
        $result = [];

        foreach ($models as $attributes) {
            if (!empty($attributes['id'])) {
                $result[] = $this->update($attributes, $attributes['id']);
            } else {
                $result[] = $this->create($attributes);
            }
        }

        return collect($result);
    }

    /**
     * Destroy the models for the given IDs.
     *
     * @param  array|int  $ids
     * @return int
     */
    public function delete($ids)
    {
        return $this->model->destroy($ids);
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
        return $this->model->findOrFail($id, $columns);
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
        return $this->model->with($relations)->findOrFail($id, $columns);
    }

    /**
     * Search for the models from the database.
     *
     * @param  array  $query
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function search(array $query, array $columns = [])
    {
        $searchKey = config('url.keys.search');
        $this->checkURLQuery($query);

        if (empty($columns) && $this->model instanceof \App\Contracts\Searchable) {
            $columns = $this->model->getSearchableColumns();
        }

        if (!empty($query[$searchKey])) {
            foreach ($columns as $column) {
                $this->builder->orWhere($column, 'like', '%'.$query[$searchKey].'%');
            }
        }

        return $this->builder->get();
    }

    /**
     * Search for the models from the database with relations.
     *
     * @param  array  $query
     * @param  array  $columns
     * @param  array|string  $relations
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function searchWithRelations(array $query, array $columns = [], $relations = [])
    {
        $searchKey = config('url.keys.search');
        $this->builder->with($relations);
        $this->checkURLQuery($query);

        if (empty($columns) && $this->model instanceof \App\Contracts\Searchable) {
            $columns = $this->model->getSearchableColumns();
        }

        if (!empty($query[$searchKey])) {
            foreach ($columns as $column) {
                $this->builder->orWhere($column, 'like', '%'.$query[$searchKey].'%');
            }
        }

        return $this->builder->get();
    }

    /**
     * Set the relationships that should be eager loaded.
     *
     * @param  mixed $relations
     * @return App\Repositories\Repository
     */
    public function with($relations)
    {
        $this->builder->with($relations);

        return $this;
    }

    /**
     * Set the relationships that should be eager loaded.
     *
     * @param  array $query
     * @return App\Repositories\Repository
     */
    public function checkURLQuery(array $query)
    {
        $limitKey = config('url.keys.limit');
        if (!empty($query[$limitKey])) {
            $this->builder->take($query[$limitKey]);
        }

        $offsetKey = config('url.keys.offset');
        if (!empty($query[$offsetKey])) {
            $this->builder->skip($query[$offsetKey]);
        }

        return $this;
    }
}
