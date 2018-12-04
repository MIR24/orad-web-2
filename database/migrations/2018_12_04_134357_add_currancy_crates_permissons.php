<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class AddCurrancyCratesPermissons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'update_val1_currencyrates']);
        Permission::create(['name' => 'update_val2_currencyrates']);
        Permission::create(['name' => 'update_dir_currencyrates']);
        Permission::create(['name' => 'update_value_currencyrates']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::where('name', 'update_val1_currencyrates')
            ->orWhere('name', 'update_val2_currencyrates')
            ->orWhere('name', 'update_dir_currencyrates')
            ->orWhere('name', 'update_value_currencyrates')
            ->delete();
    }
}
