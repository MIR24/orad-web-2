<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixTopsViewCount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW TopsView AS SELECT ((SELECT count(0) FROM Tops WHERE (t.id < Tops.id)) + 1) AS id, tc.text AS category, t.text AS text, (SELECT count(Tops.id)  FROM Tops  WHERE ((`orad`.`Tops`.`category_id` = `t`.`category_id`) AND isnull(`orad`.`Tops`.`deleted_at`) AND isnull(`t`.`deleted_at`))) AS COUNT, (SELECT count(TopsCategories.id) FROM TopsCategories WHERE deleted_at IS NULL) AS themes_count FROM (Tops t  LEFT JOIN TopsCategories tc on((tc.id = t.category_id))) WHERE tc.deleted_at IS NULL AND t.deleted_at IS NULL ORDER BY id DESC');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS TopsView');
    }
}
