<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Traits\FrequentlyCreatedTables;
use Carbon\Carbon;

class CreateTickerStringsTable extends Migration
{
    use FrequentlyCreatedTables;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->createCategoryAndStringTables('TickersCategories', 'Tickers');

        $now = Carbon::now();
        $typeToCategory = [
            'BEG' => 1,
            'REP' => 2
        ];

        DB::table('TickersCategories')->insert([
            [
                'id' => $typeToCategory['BEG'],
                'text' => 'Анонс',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'id' => $typeToCategory['REP'],
                'text' => 'Прямая трансляция',
                'created_at' => $now,
                'updated_at' => $now
            ]
        ]);

        if (Schema::hasTable('Content')) {
            $oldStrings = DB::table('Content')->get();
            if (!empty($oldStrings)) {
                $convertedStrings = [];
                foreach ($oldStrings as $oldString) {
                    if (array_key_exists($oldString->TextType, $typeToCategory)) {
                        $convertedStrings[] = [
                            'text' => $oldString->Text,
                            'category_id' => $typeToCategory[$oldString->TextType],
                            'created_at' => $now,
                            'updated_at' => $now
                        ];
                    }
                }
                DB::table('Tickers')->insert($convertedStrings);
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->deleteCategoryAndStringTables('TickersCategories', 'Tickers');
    }
}
