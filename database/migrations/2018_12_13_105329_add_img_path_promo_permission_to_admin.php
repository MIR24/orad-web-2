<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Role;

class AddImgPathPromoPermissionToAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::where(['guard_name' => 'web', 'name' => 'Admin'])->first();
        if (!empty($role)) {
            $role->givePermissionTo('update_img_path_promos');
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::where(['guard_name' => 'web', 'name' => 'Admin'])->first();
        if (!empty($role)) {
            $role->revokePermissionTo('update_img_path_promos');
        }
    }
}
