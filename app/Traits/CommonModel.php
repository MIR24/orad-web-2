<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait CommonModel
{
    /**
     * Update the model in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function updateModel(Request $request, $id)
    {
        $model = (new static)::findOrFail($id);
        $model->update($request->input('data'));

        return (new static)::findOrFail($id);
    }

    /**
     * Search given columns for query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function searchModels(Request $request, $columns = [])
    {
        $query = $request->query('q');

        $builder = (new static)::query();

        if (!empty($query)) {
            foreach ($columns as $column) {
                $builder->orWhere($column, 'like', '%'.$query.'%');
            }
        }

        return $builder->get();
    }
}
