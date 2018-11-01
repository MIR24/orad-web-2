<?php

namespace App\Repositories;

use App\Repositories\Repository;

class PhotoRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'App\Photo';
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
        return $this->findOrFailWithRelations($id, $columns, ['category']);
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
        return $this->searchWithRelations($query, $columns, ['category']);
    }
}
