<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTimeshiftFieldTypeInCityTimeshiftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('CityTimeshifts', function (Blueprint $table) {
            $table->bigInteger('timeshift')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('CityTimeshifts', function (Blueprint $table) {
            $table->unsignedInteger('timeshift')->change();
        });
    }
}
