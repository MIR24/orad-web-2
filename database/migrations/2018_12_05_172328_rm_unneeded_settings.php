<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RmUnneededSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('Settings')->where('param', '=', 'TOP_HEADER_LENGTH')->delete();
        DB::table('Settings')->where('param', '=', 'HOT_HEADER_LENGTH')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('Settings')->insert([
            ['param' => 'TOP_HEADER_LENGTH', 'value' => 0, 'desc' => 'Макс. длина заголовка топов'],
            ['param' => 'HOT_HEADER_LENGTH', 'value' => 0, 'desc' => 'Макс. длина заголовка в разделе "срочно"']
        ]);
    }
}
