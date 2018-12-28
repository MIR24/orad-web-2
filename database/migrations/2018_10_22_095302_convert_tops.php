<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ConvertTops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tops', function (Blueprint $table) {
            // need fix
            //$table->dropIndex('top_category_fk');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->string('text', 511)->change();
        });
        Schema::table('Tops', function (Blueprint $table) {
            $table->index('text');
            $table->index('category_id');
        });
        Schema::table('TopsCategories', function (Blueprint $table) {
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->renameColumn('name', 'text');
        });
        Schema::table('TopsCategories', function (Blueprint $table) {
            $table->index('text');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Tops', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
            $table->dropIndex('tops_category_id_index');
            $table->dropIndex('tops_text_index');
        });
        Schema::table('Tops', function (Blueprint $table) {
            $table->text('text')->change();
            $table->index('category_id', 'top_category_fk');
        });
        Schema::table('TopsCategories', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
            $table->dropIndex('topscategories_text_index');
            $table->renameColumn('text', 'name');
        });
    }
}
