<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::rename('Categories', 'PhotosCategories');
        Schema::rename('Photo', 'Photos');

        Schema::table('PhotosCategories', function (Blueprint $table) {
            $table->nullableTimestamps();
            $table->softDeletes();
        });

        Schema::table('Photos', function (Blueprint $table) {
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
        Schema::table('PhotosCategories', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });

        Schema::table('Photos', function (Blueprint $table) {
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });

        Schema::rename('PhotosCategories', 'Categories');
        Schema::rename('Photos', 'Photo');
    }
}
