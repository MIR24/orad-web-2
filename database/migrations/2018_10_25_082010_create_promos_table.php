<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('PromoCategories', 'PromosCategories');
        Schema::rename('Promo', 'Promos');

        Schema::table('PromosCategories', function (Blueprint $table) {
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::table('Promos', function (Blueprint $table) {
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
        Schema::table('PromosCategories', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });

        Schema::table('Promos', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });

        Schema::rename('PromosCategories', 'PromoCategories');
        Schema::rename('Promos', 'Promo');
    }
}
