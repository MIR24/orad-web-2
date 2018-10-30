<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

trait FrequentlyCreatedTables
{
    /**
     * Create category and string tables.
     *
     * @param  string   $categoryTableName
     * @param  string   $stringTableName
     * @return void
     */
    public function createCategoryAndStringTables($categoryTableName, $stringTableName)
    {
        Schema::create($stringTableName, function (Blueprint $table) {
            $table->increments('id');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->string('text', 511)->index();
            $table->integer('category_id')->index();
        });
        Schema::create($categoryTableName, function (Blueprint $table) {
            $table->increments('id');
            $table->nullableTimestamps();
            $table->softDeletes();
            $table->string('text', 255)->index();
        });
    }

    /**
     * Delete category and string tables.
     *
     * @param  string   $categoryTableName
     * @param  string   $stringTableName
     * @return void
     */
    public function deleteCategoryAndStringTables($categoryTableName, $stringTableName)
    {
        Schema::dropIfExists($categoryTableName);
        Schema::dropIfExists($stringTableName);
    }
}
