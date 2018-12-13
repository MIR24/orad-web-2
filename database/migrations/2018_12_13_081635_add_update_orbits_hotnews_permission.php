<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use App\Role;

class AddUpdateOrbitsHotnewsPermission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'update_orbits_hotnews']);

        $role = Role::where(['guard_name' => 'web', 'name' => 'Hotnews-editor'])->first();
        if (!empty($role)) {
            $role->givePermissionTo('update_orbits_hotnews');
        }

        $role = Role::where(['guard_name' => 'web', 'name' => 'Admin'])->first();
        if (!empty($role)) {
            $role->givePermissionTo('update_orbits_hotnews');
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

        Permission::where('name', 'update_orbits_hotnews')->delete();
    }
}
