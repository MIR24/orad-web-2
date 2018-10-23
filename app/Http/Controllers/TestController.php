<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function getTops()
    {
        return [
            0 => [
                'title' => 'title0', 
                'releated' => [
                    0 => ['text' => 'text0']
                ]
            ],
            1 => [
                'title' => 'title1', 
                'releated' => [
                    0 => ['text' => 'text10'],
                    1 => ['text' => 'text11'],
                    2 => ['text' => 'text12'],
                ]
            ],
            2 => [
                'title' => 'title2', 
                'releated' => [
                    0 => ['text' => 'text2']
                ]
            ]
        ];
    }
    public function getNewsbar()
    {
        return [
            0 => [
                'title' => 'title0',
                'releated' => [
                    0 => ['text' => 'text0']
                ]
            ],
            1 => [
                'title' => 'title1',
                'releated' => [
                    0 => ['text' => 'text10'],
                    1 => ['text' => 'text11'],
                    2 => ['text' => 'text12'],
                ]
            ]
        ];
    }
    public function getExpedited()
    {
        return [
            0 => [
                'title' => 'title0',
                'releated' => [
                    0 => ['text' => 'text0']
                ],
                'oribts' => [
                    0 => [
                        'id' => 0,
                        'name' => 'orbit0'
                    ],
                    1 => [
                        'id'=> 1,
                        'name' => 'orbit1'
                    ],
                ]
            ],
            1 => [
                'title' => 'title1',
                'releated' => [
                    0 => ['text' => 'text10'],
                    1 => ['text' => 'text11'],
                    2 => ['text' => 'text12'],
                ],
                'oribts' => []
            ]
        ];
    }
}
