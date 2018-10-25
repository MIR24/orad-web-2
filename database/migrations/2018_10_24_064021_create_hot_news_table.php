<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Traits\FrequentlyCreatedTables;
use Caerbon\Carbon;

class CreateHotNewsTable extends Migration
{
    use FrequentlyCreatedTables;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('HotNews');

        $this->createCategoryAndStringTables('HotNewsCategories', 'HotNews');

        Schema::create('HotNewsCategories_Orbit', function (Blueprint $table) {
            $table->integer('Orbit_id');
            $table->integer('HotNewsCategoriy_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->deleteCategoryAndStringTables('HotNewsCategories', 'HotNews');

        Schema::dropIfExists('HotNewsCategories_Orbit');
    }
}
