<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CastWeatherTemperaturesToSigned extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW WeatherForecastsView AS SELECT city, cast(morning AS signed) as morning, cast(evening as signed) as evening, weather_type_id AS icon FROM WeatherForecasts WHERE deleted_at IS NULL');
        DB::statement('CREATE OR REPLACE VIEW WeatherForecastsLinerView AS SELECT city, cast(now as signed) as now, cast(morning AS signed) as morning, cast(evening as signed) as evening, weather_type_id AS icon FROM WeatherForecastsLiner WHERE deleted_at IS NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS WeatherForecastsView');
        DB::statement('DROP VIEW IF EXISTS WeatherForecastsLinerView');
    }
}
