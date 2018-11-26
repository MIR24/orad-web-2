<?php

namespace App\Repositories;

use App\Repositories\Repository;

class UserRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    protected function model()
    {
        return 'Backpack\Base\app\Models\BackpackUser';
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPermissions(int $id)
    {
        $model = $this->model->findOrFail($id);

        return $model->getAllPermissions();
    }
}
