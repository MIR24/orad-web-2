<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW BreakingView AS SELECT `hnc`.`id` AS `id`, `hnc`.`text` AS `title`, `hn`.`text` AS `text` FROM (`HotNews` `hn` LEFT JOIN `HotNewsCategories` `hnc` on((`hnc`.`id` = `hn`.`category_id`)))');

        DB::statement('CREATE OR REPLACE VIEW ExchangeView AS SELECT val1 AS Val1, val1 AS Val2, dir AS Diff, value AS Kurs FROM CurrencyRates');

        DB::statement('CREATE OR REPLACE VIEW PromoView AS SELECT p.mir_id AS mir_id, p.mirhd_id AS mirhd_id, p.age AS age, p.name AS name , ucase(p.name) AS uc_name, p.header AS header, p.subheader AS subheader, p.mode AS mode, p.img_path AS pic, pc.text AS category from Promos as p JOIN PromosCategories AS pc on p.category_id = pc.id');

        DB::statement('CREATE OR REPLACE VIEW TopsView AS SELECT ((SELECT count(0) FROM `Tops` WHERE (`t`.`id` < `Tops`.`id`)) + 1) AS `id`, `tc`.`text` AS `category`, `t`.`text` AS `text`, (SELECT count(`Tops`.`id`) FROM `Tops` WHERE (`Tops`.`category_id` = `t`.`category_id`)) AS `count`, (SELECT count(`TopsCategories`.`id`) FROM `TopsCategories`) AS `themes_count` FROM (`Tops` `t` LEFT JOIN `TopsCategories` `tc` on((`tc`.`id` = `t`.`category_id`))) ORDER BY `tc`.`id`');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS BreakingView');
        DB::statement('DROP VIEW IF EXISTS ExchangeView');
        DB::statement('DROP VIEW IF EXISTS PromoView');
        DB::statement('DROP VIEW IF EXISTS TopsView');
    }
}
