<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use App\Role;

class CreateNowFurtherLatersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('now_further_laters', function (Blueprint $table) {
            $table->increments('id');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->integer('external_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->string('path', 255)->nullable();
        });

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'see_nowfurtherlaters']);
        Permission::create(['name' => 'create_nowfurtherlaters']);
        Permission::create(['name' => 'update_nowfurtherlaters']);
        Permission::create(['name' => 'delete_nowfurtherlaters']);
        Permission::create(['name' => 'update_name_nowfurtherlaters']);
        Permission::create(['name' => 'update_external_id_nowfurtherlaters']);
        Permission::create(['name' => 'update_path_nowfurtherlaters']);

        $role = Role::where(['guard_name' => 'web', 'name' => 'Admin'])->first();
        if (!empty($role)) {
            $role->givePermissionTo([
                'see_nowfurtherlaters',
                'create_nowfurtherlaters',
                'update_nowfurtherlaters',
                'delete_nowfurtherlaters',
                'update_name_nowfurtherlaters',
                'update_external_id_nowfurtherlaters',
                'update_path_nowfurtherlaters'
            ]);
        }

        $role = Role::create(['guard_name' => 'web', 'name' => 'NowFurtherLater-editor']);
        $role->givePermissionTo(
            'see_nowfurtherlaters',
            'create_nowfurtherlaters',
            'update_name_nowfurtherlaters',
            'update_external_id_nowfurtherlaters',
            'update_path_nowfurtherlaters'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('now_further_laters');

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::where('name', 'see_nowfurtherlaters')
            ->orWhere('name', 'create_nowfurtherlaters')
            ->orWhere('name', 'update_nowfurtherlaters')
            ->orWhere('name', 'delete_nowfurtherlaters')
            ->orWhere('name', 'update_name_nowfurtherlaters')
            ->orWhere('name', 'update_external_id_nowfurtherlaters')
            ->orWhere('name', 'update_path_nowfurtherlaters')
            ->delete();

        Role::where(['guard_name' => 'web', 'name' => 'NowFurtherLater-editor'])
            ->delete();
    }
}
