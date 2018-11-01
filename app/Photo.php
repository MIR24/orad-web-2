<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Traits\CommonModel;

class Photo extends Model
{
    use SoftDeletes;
    use CommonModel {
        searchModels as traitSearchModels;
        updateModel as traitUpdateModel;
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'title', 'path'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Photos';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'Id';

    /**
     * Get the category for the strings.
     */
    public function category()
    {
        return $this->belongsTo('App\PhotoCategory', 'Category_id', 'Id');
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
        $models = (new static)::traitSearchModels($request, $columns);

        if (!empty($models)) {
            $models->load('category');
        }

        return $models;
    }

    /**
     * Update the model in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public static function updateModel(Request $request, $id)
    {
        $model = (new static)::traitUpdateModel($request, $id);

        if (!empty($model)) {
            $model->load('category');
        }

        return $models;
    }
}
