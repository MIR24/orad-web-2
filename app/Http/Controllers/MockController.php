<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MockController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function getTops()
    {
        return ["rows" => [
            ['id' => 1, 'title' => 'lorem ipsum 1', 'text' => 'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf'],
            ['id' => 2, 'title' => 'lorem ipsum 2', 'text' => 'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf'],
            ['id' => 3, 'title' => 'lorem ipsum 3', 'text' => 'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf'],
            ['id' => 4, 'title' => 'lorem ipsum 4', 'text' => 'Dolor sit amet sdlgflsjdg safjdlaskdf aslkdfj;askj;al sdk adf askdjf ;alskdfj a;lsdkf'],
        ]];
    }

    public function getNewsbar()
    {
        return [
            'tops' => "sdfgjklsdjfglkdjsgjsdkjfglg\nsdfjghjsdhfgkjsdhflkgsdhfgldjkshg\nsidfjgksdhfgkhjlsdhglkds\nsfjhgsjdkhgkjsdhlkjghsldkjhg",
            'ticker' => "sdfgjklsdjfglkdjsgjsdkjfglg\nsdfjghjsdhfgkjsdhflkgsdhfgldjkshg\nsidfjgksdhfgkhjlsdhglkds\nsfjhgsjdkhgkjsdhlkjghsldkjhg",
        ];
    }
}
