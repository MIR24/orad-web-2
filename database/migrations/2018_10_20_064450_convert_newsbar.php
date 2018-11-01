<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Traits\FrequentlyCreatedTables;
use Carbon\Carbon;

class ConvertNewsbar extends Migration
{
    use FrequentlyCreatedTables;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createCategoryAndStringTables('NewsbarsCategories', 'Newsbars');

        if (!Schema::hasTable('Newsbar')) {
            return;
        }

        $oldStrings = DB::table('Newsbar')->get();
        if (empty($oldStrings)) {
            return;
        }

        $now = Carbon::now();
        $convertedStrings = [];
        $typeToCategory = [
            'TOP' => 1,
            'BEG' => 2
        ];

        DB::table('NewsbarsCategories')->insert([
            [
                'id' => $typeToCategory['TOP'],
                'text' => 'Топы',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => $typeToCategory['BEG'],
                'text' => 'Бегущая строка',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        foreach ($oldStrings as $oldString) {
            $convertedStrings[] = [
                'text' => $oldString->text,
                'category_id' => $typeToCategory[$oldString->type],
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        DB::table('Newsbars')->insert($convertedStrings);

        Schema::dropIfExists('Newsbar');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->deleteCategoryAndStringTables('NewsbarsCategories', 'Newsbars');
    }
}
