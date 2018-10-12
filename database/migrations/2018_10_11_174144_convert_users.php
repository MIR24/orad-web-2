<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class ConvertUsers extends Migration
{
    /**
     * Developer user attributes.
     *
     * @var array
     */
    protected $devUser = [
        'email' => 'dev@mirtv.ru',
        'name' => 'Developer',
        'password' => 'orad2devpass',
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $oldUsers = DB::table('DBUsers')->get();
        $convertedUsers = [];
        $now = Carbon::now();

        $convertedUsers[] = [
            'email' => $this->devUser['email'],
            'name' => $this->devUser['name'],
            'password' => Hash::make($this->devUser['password']),
            'created_at' => $now,
            'updated_at' => $now
        ];

        foreach ($oldUsers as $oldUser) {
            $convertedUsers[] = [
                'email' => $oldUser->UserName.'@mirtv.ru',
                'name' => $oldUser->UserName,
                'password' => Hash::make($oldUser->Password),
                'created_at' => $now,
                'updated_at' => $now
            ];
        }

        DB::table('users')->insert($convertedUsers);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('users')->truncate();
    }
}
