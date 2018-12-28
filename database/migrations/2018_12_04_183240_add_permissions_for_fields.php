<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;

class AddPermissionsForFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'update_city_citytimeshifts']);
        Permission::create(['name' => 'update_timeshift_citytimeshifts']);

        Permission::create(['name' => 'update_title_eventcountdowns']);
        Permission::create(['name' => 'update_description_eventcountdowns']);
        Permission::create(['name' => 'update_happen_at_eventcountdowns']);

        Permission::create(['name' => 'update_text_hotnews']);
        Permission::create(['name' => 'update_strings_hotnews']);

        Permission::create(['name' => 'update_text_newsbars']);
        Permission::create(['name' => 'update_strings_newsbars']);

        Permission::create(['name' => 'update_name_orbits']);

        Permission::create(['name' => 'update_text_photocategories']);

        Permission::create(['name' => 'update_name_photos']);
        Permission::create(['name' => 'update_title_photos']);
        Permission::create(['name' => 'update_category_id_photos']);
        Permission::create(['name' => 'update_path_photos']);

        Permission::create(['name' => 'update_text_promocategories']);

        Permission::create(['name' => 'update_mir_id_promos']);
        Permission::create(['name' => 'update_mirhd_id_promos']);
        Permission::create(['name' => 'update_category_id_promos']);
        Permission::create(['name' => 'update_age_promos']);
        Permission::create(['name' => 'update_name_promos']);
        Permission::create(['name' => 'update_header_promos']);
        Permission::create(['name' => 'update_subheader_promos']);
        Permission::create(['name' => 'update_mode_promos']);

        Permission::create(['name' => 'update_param_settings']);
        Permission::create(['name' => 'update_desc_settings']);
        Permission::create(['name' => 'update_value_settings']);

        Permission::create(['name' => 'update_name_tabs']);
        Permission::create(['name' => 'update_message_tabs']);
        Permission::create(['name' => 'update_position_tabs']);

        Permission::create(['name' => 'update_text_tickers']);
        Permission::create(['name' => 'update_strings_tickers']);

        Permission::create(['name' => 'update_text_tops']);
        Permission::create(['name' => 'update_strings_tops']);

        Permission::create(['name' => 'update_type_weathertypes']);
        Permission::create(['name' => 'update_icon_weathertypes']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::where('name', 'update_city_citytimeshifts')
            ->orWhere('name', 'update_timeshift_citytimeshifts')

            ->orWhere('name', 'update_title_eventcountdowns')
            ->orWhere('name', 'update_description_eventcountdowns')
            ->orWhere('name', 'update_happen_at_eventcountdowns')

            ->orWhere('name', 'update_text_hotnews')
            ->orWhere('name', 'update_strings_hotnews')

            ->orWhere('name', 'update_text_newsbars')
            ->orWhere('name', 'update_strings_newsbars')

            ->orWhere('name', 'update_name_orbits')

            ->orWhere('name', 'update_text_photocategories')

            ->orWhere('name', 'update_name_photos')
            ->orWhere('name', 'update_title_photos')
            ->orWhere('name', 'update_category_id_photos')
            ->orWhere('name', 'update_path_photos')

            ->orWhere('name', 'update_text_promocategories')

            ->orWhere('name', 'update_mir_id_promos')
            ->orWhere('name', 'update_mirhd_id_promos')
            ->orWhere('name', 'update_category_id_promos')
            ->orWhere('name', 'update_age_promos')
            ->orWhere('name', 'update_name_promos')
            ->orWhere('name', 'update_header_promos')
            ->orWhere('name', 'update_subheader_promos')
            ->orWhere('name', 'update_mode_promos')

            ->orWhere('name', 'update_param_settings')
            ->orWhere('name', 'update_desc_settings')
            ->orWhere('name', 'update_value_settings')

            ->orWhere('name', 'update_name_tabs')
            ->orWhere('name', 'update_message_tabs')
            ->orWhere('name', 'update_position_tabs')

            ->orWhere('name', 'update_text_tickers')
            ->orWhere('name', 'update_strings_tickers')

            ->orWhere('name', 'update_text_tops')
            ->orWhere('name', 'update_strings_tops')

            ->orWhere('name', 'update_type_weathertypes')
            ->orWhere('name', 'update_icon_weathertypes')
            ->delete();
    }
}
