<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoreViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        
        DB::statement('CREATE OR REPLACE VIEW NewsbarView AS SELECT nc.text AS title, n.text AS text FROM NewsbarsCategories AS nc LEFT JOIN Newsbars as n ON nc.id = n.category_id ORDER BY nc.id');
        DB::statement('CREATE OR REPLACE VIEW WeatherForecastsView AS SELECT city, morning, evening, weather_type_id AS icon FROM WeatherForecasts WHERE deleted_at IS NULL');
        DB::statement('CREATE OR REPLACE VIEW WeatherForecastsLinerView AS SELECT city, now, morning, evening, weather_type_id AS icon FROM WeatherForecastsLiner WHERE deleted_at IS NULL');
        DB::statement('CREATE OR REPLACE VIEW CityTimeshiftsView AS SELECT city, timeshift FROM CityTimeshifts WHERE deleted_at IS NULL');
        DB::statement('CREATE OR REPLACE VIEW EventCountdownsView AS SELECT title, happen_at FROM EventCountdowns WHERE deleted_at IS NUll');
        DB::statement('CREATE OR REPLACE VIEW NowFurtherLaterView AS SELECT id, external_id, name, path AS pic FROM now_further_laters WHERE deleted_at IS NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS NewsbarView');
        DB::statement('DROP VIEW IF EXISTS WeatherForecastsView');
        DB::statement('DROP VIEW IF EXISTS WeatherForecastsLinerView');
        DB::statement('DROP VIEW IF EXISTS CityTimeshiftsView');
        DB::statement('DROP VIEW IF EXISTS EventCountdownsView');
        DB::statement('DROP VIEW IF EXISTS NowFurtherLaterView');
    }
}
