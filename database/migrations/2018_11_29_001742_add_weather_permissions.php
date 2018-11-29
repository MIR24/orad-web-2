<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class AddWeatherPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::where('name', 'edit_status_weatherforecasts')
            ->orWhere('name', 'edit_status_weatherforecastsliners')
            ->delete();

        Permission::create(['name' => 'update_status_weatherforecasts']);
        Permission::create(['name' => 'update_city_weatherforecasts']);
        Permission::create(['name' => 'update_morning_weatherforecasts']);
        Permission::create(['name' => 'update_evening_weatherforecasts']);
        Permission::create(['name' => 'update_weather_type_id_weatherforecasts']);

        Permission::create(['name' => 'update_status_weatherforecastsliners']);
        Permission::create(['name' => 'update_city_weatherforecastsliners']);
        Permission::create(['name' => 'update_morning_weatherforecastsliners']);
        Permission::create(['name' => 'update_now_weatherforecastsliners']);
        Permission::create(['name' => 'update_evening_weatherforecastsliners']);
        Permission::create(['name' => 'update_weather_type_id_weatherforecastsliners']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::where('name', 'update_status_weatherforecasts')
            ->orWhere('name', 'update_city_weatherforecasts')
            ->orWhere('name', 'update_morning_weatherforecasts')
            ->orWhere('name', 'update_evening_weatherforecasts')
            ->orWhere('name', 'update_weather_type_id_weatherforecasts')
            ->orWhere('name', 'update_status_weatherforecastsliners')
            ->orWhere('name', 'update_city_weatherforecastsliners')
            ->orWhere('name', 'update_morning_weatherforecastsliners')
            ->orWhere('name', 'update_now_weatherforecastsliners')
            ->orWhere('name', 'update_evening_weatherforecastsliners')
            ->orWhere('name', 'update_weather_type_id_weatherforecastsliners')
            ->delete();

        Permission::create(['name' => 'edit_status_weatherforecasts']);
        Permission::create(['name' => 'edit_status_weatherforecastsliners']);
    }
}
