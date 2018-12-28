<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeHappenAtTypeInEventcountdownsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('EventCountdowns', function (Blueprint $table) {
            $table->bigInteger('happen_at_tmp')->unsigned()->nullable();
        });

        DB::statement("UPDATE EventCountdowns SET happen_at_tmp = UNIX_TIMESTAMP(happen_at);");

        Schema::table('EventCountdowns', function (Blueprint $table) {
            $table->bigInteger('happen_at')->unsigned()->nullable()->change();
        });

        DB::statement("UPDATE EventCountdowns SET happen_at = happen_at_tmp;");

        Schema::table('EventCountdowns', function (Blueprint $table) {
            $table->dropColumn('happen_at_tmp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE EventCountdowns CHANGE happen_at happen_at VARCHAR(255);");
        DB::statement("UPDATE EventCountdowns SET happen_at = FROM_UNIXTIME(happen_at);");
        DB::statement("ALTER TABLE EventCountdowns CHANGE happen_at happen_at TIMESTAMP NULL;");
    }
}
