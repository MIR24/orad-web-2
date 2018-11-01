<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherForecastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('WeatherForecasts', function (Blueprint $table) {
            $table->increments('id');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->enum('status', ['active', 'inactive']);
            $table->string('city', 70);
            $table->tinyInteger('morning');
            $table->tinyInteger('now');
            $table->tinyInteger('evening');
            $table->integer('weather_type_id');
        });

        Schema::table('WeatherTypes', function (Blueprint $table) {
            $table->nullableTimestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('WeatherForecasts');

        Schema::table('WeatherTypes', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });
    }
}
