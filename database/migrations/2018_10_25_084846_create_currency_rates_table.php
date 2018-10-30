<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCurrencyRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CurrencyRates', function (Blueprint $table) {
            $table->increments('id');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->string('val1', 5);
            $table->string('val2', 5);
            $table->enum('dir', ['rise', 'fall', 'stay']);
            $table->float('value', 8, 4);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CurrencyRates');
    }
}
