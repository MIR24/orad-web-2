<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeatherLiveLiner extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('WeatherForecastsLiner', function (Blueprint $table) {
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
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('WeatherForecastsLiner');
    }
}
