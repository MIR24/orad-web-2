<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Tab;
use Backpack\Base\app\Models\BackpackUser as User;

class UpdateTabs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tabs', function (Blueprint $table) {
            $table->string('seePremission');
            $table->string('jsClass');
            $table->dropColumn('position');
            $table->string('name')->nullable()->default(null)->change();
            $table->string('message')->nullable()->default(null)->change();
        });
        
        Tab::insert([
            [
                'jsClass' => 'Tops',
                'seePremission' => 'see_tops',
                'message' => null,
                'name' => 'Топы'
            ],
            [
                'jsClass' => 'Newsbar',
                'seePremission' => 'see_newsbars',
                'message' => null,
                'name' => 'Newsbar'
            ],
            [
                'jsClass' => 'Expedited',
                'seePremission' => 'see_hotnews',
                'message' => null,
                'name' => 'Срочно'
            ],
            [
                'jsClass' => 'CurrencyValues',
                'seePremission' => 'see_currencyrates',
                'message' => null,
                'name' => 'Курс валют'
            ],
            [
                'jsClass' => 'WeatherLive',
                'seePremission' => 'see_weatherforecasts',
                'message' => null,
                'name' => 'Погода для эфира'
            ],
            [
                'jsClass' => 'WeatherLiveLiner',
                'seePremission' => 'see_weatherforecastsliners',
                'message' => null,
                'name' => 'Погода для подводки'
            ],
            [
                'jsClass' => 'TimeShift',
                'seePremission' => 'see_citytimeshifts',
                'message' => null,
                'name' => 'Время'
            ],
            [
                'jsClass' => 'Countdown',
                'seePremission' => 'see_eventcountdowns',
                'message' => null,
                'name' => 'Счетчик события'
            ],
            [
                'jsClass' => 'Promo',
                'seePremission' => 'see_promos',
                'message' => null,
                'name' => 'Промо'
            ],
            [
                'jsClass' => 'PhotoUpload',
                'seePremission' => 'see_nowfurtherlaters',
                'message' => null,
                'name' => 'Сейчас далее потом'
            ],
            [
                'jsClass' => 'AdminControl',
                'seePremission' => 'see_admin_interface',
                'message' => null,
                'name' => 'Управление'
            ]
        ]);

        foreach (User::all() as $user) {
            $user->givePermissionTo('see_tabs');
        }
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('tabs')->truncate();
        Schema::table('tabs', function (Blueprint $table) {
            $table->dropColumn('seePremission');
            $table->dropColumn('jsClass');
            $table->integer('position')->nullble()->unique();
        });
        foreach (User::all() as $user) {
            $user->revokePermissionTo('see_tabs');
        }
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
    }
}
