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
            'update_text_tops',
            'update_strings_tops',
            'see_settings'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Tops-admin']);
        $role->givePermissionTo(
            'see_tops',
            'create_tops',
            'delete_tops',
            'update_tops',
            'update_text_tops',
            'update_strings_tops',
            'see_settings'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Newsbars-editor']);
        $role->givePermissionTo(
            'see_newsbars',
            'update_newsbars',
            'update_text_newsbars',
            'update_strings_newsbars',
            'see_settings'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Newsbars-admin']);
        $role->givePermissionTo(
            'see_newsbars',
            'create_newsbars',
            'delete_newsbars',
            'update_newsbars',
            'update_text_newsbars',
            'update_strings_newsbars',
            'see_settings'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Hotnews-editor']);
        $role->givePermissionTo(
            'see_hotnews',
            'create_hotnews',
            'delete_hotnews',
            'update_hotnews',
            'update_text_hotnews',
            'update_strings_hotnews',
            'see_settings',
            'see_orbits'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Hotnews-admin']);
        $role->givePermissionTo(
            'see_hotnews',
            'create_hotnews',
            'delete_hotnews',
            'update_hotnews',
            'update_text_hotnews',
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

        $role = Role::create(['guard_name' => 'web', 'name' => 'Currencyrates-admin']);
        $role->givePermissionTo(
            'see_currencyrates',
            'create_currencyrates',
            'delete_currencyrates',
            'update_currencyrates',
            'update_val1_currencyrates',
            'update_val2_currencyrates',
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

        $role = Role::create(['guard_name' => 'web', 'name' => 'Weatherforecasts-admin']);
        $role->givePermissionTo(
            'see_weatherforecasts',
            'create_weatherforecasts',
            'delete_weatherforecasts',
            'update_weatherforecasts',
            'update_status_weatherforecasts',
            'update_city_weatherforecasts',
            'update_morning_weatherforecasts',
            'update_evening_weatherforecasts',
            'update_weather_type_id_weatherforecasts',
            'see_weathertypes',
            'create_weathertypes',
            'update_weathertypes',
            'delete_weathertypes',
            'update_type_weathertypes',
            'update_icon_weathertypes'
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

        $role = Role::create(['guard_name' => 'web', 'name' => 'Weatherforecastsliners-admin']);
        $role->givePermissionTo(
            'see_weatherforecastsliners',
            'create_weatherforecastsliners',
            'delete_weatherforecastsliners',
            'update_weatherforecastsliners',
            'update_status_weatherforecastsliners',
            'update_city_weatherforecastsliners',
            'update_morning_weatherforecastsliners',
            'update_now_weatherforecastsliners',
            'update_evening_weatherforecastsliners',
            'update_weather_type_id_weatherforecastsliners',
            'see_weathertypes',
            'create_weathertypes',
            'update_weathertypes',
            'delete_weathertypes',
            'update_type_weathertypes',
            'update_icon_weathertypes'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Citytimeshifts-admin']);
        $role->givePermissionTo(
            'see_citytimeshifts',
            'create_citytimeshifts',
            'delete_citytimeshifts',
            'update_citytimeshifts',
            'update_city_citytimeshifts',
            'update_timeshift_citytimeshifts'
        );

        $role = Role::create(['guard_name' => 'web', 'name' => 'Eventcountdowns-admin']);
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

        $role = Role::create(['guard_name' => 'web', 'name' => 'Promos-admin']);
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
            'see_promocategories',
            'create_promocategories',
            'update_promocategories',
            'delete_promocategories',
            'update_text_promocategories'
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
