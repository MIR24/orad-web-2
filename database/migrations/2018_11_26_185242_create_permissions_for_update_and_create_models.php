<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class CreatePermissionsForUpdateAndCreateModels extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $actions = [
            'see',
            'create',
            'update',
            'delete',
        ];
        $glue = '_';
        $modelAliases = [
            'citytimeshifts',
            'currencyrates',
            'eventcountdowns',
            'hotnews',
            'newsbars',
            'orbits',
            'photocategories',
            'photos',
            'promocategories',
            'promos',
            'settings',
            'tabs',
            'tickers',
            'tops',
            'users',
            'weatherforecasts',
            'weatherforecastliners',
            'weathertypes',
        ];

        // create permissions
        foreach ($actions as $action) {
            foreach ($modelAliases as $modelAlias) {
                Permission::create(['name' => $action.$glue.$modelAlias]);
            }
        }
        Permission::create(['name' => 'edit_status_weatherforecasts']);
        Permission::create(['name' => 'edit_status_weatherforecastliners']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('permissions')->delete();

    }
}
