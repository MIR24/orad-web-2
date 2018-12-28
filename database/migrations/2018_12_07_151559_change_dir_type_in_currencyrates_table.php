<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDirTypeInCurrencyRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::statement("ALTER TABLE CurrencyRates MODIFY dir TINYINT NULL");
        Schema::table('CurrencyRates', function (Blueprint $table) {
            $table->string('val1', 5)->nullable()->change();
            $table->string('val2', 5)->nullable()->change();
            $table->float('value', 8, 4)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('CurrencyRates', function (Blueprint $table) {
            $table->string('val1', 5)->nullable(false)->change();
            $table->string('val2', 5)->nullable(false)->change();
            $table->float('value', 8, 4)->nullable(false)->change();
        });
        DB::statement("ALTER TABLE CurrencyRates MODIFY dir ENUM('rise', 'fall', 'stay') NULL");
    }
}
