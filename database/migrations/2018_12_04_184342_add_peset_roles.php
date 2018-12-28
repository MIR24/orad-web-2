<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use App\Role;

class AddPesetRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('roles')->where('name', '<>', 'Super-admin')
            ->delete();

        $role = Role::create(['guard_name' => 'web', 'name' => 'Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['guard_name' => 'web', 'name' => 'Tops-editor']);
        $role->givePermissionTo(
            'see_tops',
            'update_tops',
            'update_strings_tops',
            'see_settings'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Newsbars-editor']);
        $role->givePermissionTo(
            'see_newsbars',
            'update_newsbars',
            'update_strings_newsbars',
            'see_settings'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Hotnews-editor']);
        $role->givePermissionTo(
            'see_hotnews',
            'create_hotnews',
            'delete_hotnews',
            'update_hotnews',
            'update_strings_hotnews',
            'see_settings',
            'see_orbits'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Currencyrates-editor']);
        $role->givePermissionTo(
            'see_currencyrates',
            'update_currencyrates',
            'update_dir_currencyrates',
            'update_value_currencyrates'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Weatherforecasts-editor']);
        $role->givePermissionTo(
            'see_weatherforecasts',
            'update_weatherforecasts',
            'update_morning_weatherforecasts',
            'update_evening_weatherforecasts',
            'update_weather_type_id_weatherforecasts',
            'see_weathertypes'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Weatherforecastsliners-editor']);
        $role->givePermissionTo(
            'see_weatherforecastsliners',
            'update_weatherforecastsliners',
            'update_morning_weatherforecastsliners',
            'update_now_weatherforecastsliners',
            'update_evening_weatherforecastsliners',
            'update_weather_type_id_weatherforecastsliners',
            'see_weathertypes'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Citytimeshifts-editor']);
        $role->givePermissionTo(
            'see_citytimeshifts',
            'create_citytimeshifts',
            'delete_citytimeshifts',
            'update_citytimeshifts',
            'update_city_citytimeshifts',
            'update_timeshift_citytimeshifts'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Eventcountdowns-editor']);
        $role->givePermissionTo(
            'see_eventcountdowns',
            'create_eventcountdowns',
            'delete_eventcountdowns',
            'update_eventcountdowns',
            'update_title_eventcountdowns',
            'update_description_eventcountdowns',
            'update_happen_at_eventcountdowns'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Promos-editor']);
        $role->givePermissionTo(
            'see_promos',
            'create_promos',
            'delete_promos',
            'update_promos',
            'update_mir_id_promos',
            'update_mirhd_id_promos',
            'update_category_id_promos',
            'update_age_promos',
            'update_name_promos',
            'update_header_promos',
            'update_subheader_promos',
            'update_mode_promos',
            'see_promocategories'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        DB::table('roles')->where('name', '<>', 'Super-admin')
            ->delete();
    }
}
