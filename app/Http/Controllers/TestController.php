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
    public function getCurrency()
    {
        return [
            0 => [
                'id' => 0,
                'val1' => 'rub',
                'val2' => 'usd',
                'dir' => 1,
                'value' => 1.21
            ],
            1 => [
                'id' => 0,
                'val1' => 'rub',
                'val2' => 'usd',
                'dir' => 2,
                'value' => 1.21
            ],
            2 => [
                'id' => 0,
                'val1' => 'rub',
                'val2' => 'usd',
                'dir' => 3,
                'value' => 1.21
            ],
        ];
    }
    public function getWeather()
    {
        return [
            0 => [
                'id' => 0,
                'state' => 1,
                'city' => 'city0',
                'morning' => 2,
                'evening' => 2,
                'icon' => [
                    'id' => 0,
                    'loc' => 'string'
                ]
            ],
            1 => [
                'id' => 1,
                'state' => 0,
                'city' => 'city1',
                'morning' => 20,
                'evening' => 22,
                'icon' => [
                    'id' => 1,
                    'loc' => 'string'
                ]
            ],
            2 => [
                'id' => 2,
                'state' => 1,
                'city' => 'city2',
                'morning' => 2,
                'evening' => 2,
                'icon' => [
                    'id' => 2,
                    'loc' => 'string'
                ]
            ],
        ];
    }
    public function getTimeShift()
    {
        return [
            0 => [
                'id' => 0,
                'city' => 'city0',
                'timeShift' => 0,
            ],
            1 => [
                'id' => 1,
                'city' => 'city1',
                'timeShift' => 1,
            ],
            2 => [
                'id' => 2,
                'city' => 'city2',
                'timeShift' => 2,
            ],
            3 => [
                'id' => 3,
                'city' => 'city3',
                'timeShift' => 3,
            ],
        ];
    }
}
