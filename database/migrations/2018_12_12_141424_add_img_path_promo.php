<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use App\Role;

class AddImgPathPromo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Promos', function (Blueprint $table) {
            $table->string('img_path', 255)->nullable();
        });

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'update_img_path_promos']);

        $role = Role::where(['guard_name' => 'web', 'name' => 'Promos-editor'])->first();
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
        Schema::table('Promos', function (Blueprint $table) {
            $table->dropColumn('img_path');
        });

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::where(['guard_name' => 'web', 'name' => 'Promos-editor'])->first();
        
        if (!empty($role)) {
            $role->revokePermissionTo('update_img_path_promos');
        }

        Permission::where('name', 'update_img_path_promos')->delete();
    }
}
