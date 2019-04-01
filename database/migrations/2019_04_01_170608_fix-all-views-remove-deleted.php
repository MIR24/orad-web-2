<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixAllViewsRemoveDeleted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('CREATE OR REPLACE VIEW BreakingView AS SELECT `hnc`.`id` AS `id`, `hnc`.`text` AS `title`, `hn`.`text` AS `text` FROM (`orad`.`HotNews` `hn` LEFT JOIN `orad`.`HotNewsCategories` `hnc` on((`hnc`.`id` = `hn`.`category_id`))) WHERE (isnull(`hnc`.`deleted_at`) AND isnull(`hn`.`deleted_at`))');

        DB::statement('CREATE OR REPLACE VIEW NewsbarView AS SELECT `nc`.`text` AS `title`, `n`.`text` AS `text` FROM (`orad`.`NewsbarsCategories` `nc` LEFT JOIN `orad`.`Newsbars` `n` on((`nc`.`id` = `n`.`category_id`))) WHERE (isnull(`n`.`deleted_at`) AND isnull(`nc`.`deleted_at`)) ORDER BY `nc`.`id`');

        DB::statement('CREATE OR REPLACE VIEW PromoView AS SELECT `p`.`mir_id` AS `mir_id`, `p`.`mirhd_id` AS `mirhd_id`, `p`.`age` AS `age`, `p`.`name` AS `name`, upper(`p`.`name`) AS `uc_name`, `p`.`header` AS `header`, `p`.`subheader` AS `subheader`, `p`.`mode` AS `mode`, `p`.`img_path` AS `pic`, `pc`.`text` AS `category` FROM (`orad`.`Promos` `p` JOIN `orad`.`PromosCategories` `pc` on((`p`.`category_id` = `pc`.`id`))) WHERE (isnull(`p`.`deleted_at`) AND isnull(`pc`.`deleted_at`))');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW IF EXISTS BreakingView');
        DB::statement('DROP VIEW IF EXISTS NewsbarView');
        DB::statement('DROP VIEW IF EXISTS PromoView');
    }
}
