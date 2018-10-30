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
    public function getCountdown()
    {
        return [
            0 => [
                'id' => 0,
                'name' => 'name0',
                'time' => '2018-12-05 10:10:38',
                'timestamp' => 123456
            ],
            1 => [
                'id' => 1,
                'name' => 'name1',
                'time' => '2018-12-05 11:10:38',
                'timestamp' => 123456
            ],
            2 => [
                'id' => 2,
                'name' => 'name2',
                'time' => '2018-12-07 12:10:38',
                'timestamp' => 123456
            ],
            3 => [
                'id' => 3,
                'name' => 'name3',
                'time' => '2018-12-06 13:10:38',
                'timestamp' => 123456
            ],
        ];
    }
    public function getPromo()
    {
        return [
            0 => [
                'id' => 0,
                'mir_id' => 0,
                'hd_id' => 0,
                'category' => 'category0',
                'name' => 'name0',
                'title' => 'title0',
                'underTitle' => 'under_title0',
                'ageRestriction' => '+0',
                'state' => 0,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg',
            ],
            1 => [
                'id' => 1,
                'mir_id' => 1,
                'hd_id' => 1,
                'category' => 'category1',
                'name' => 'name1',
                'title' => 'title1',
                'underTitle' => 'under_title1',
                'ageRestriction' => '+0',
                'state' => 0,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg',
            ],
            2 => [
                'id' => 2,
                'mir_id' => 2,
                'hd_id' => 2,
                'category' => 'category2',
                'name' => 'name2',
                'title' => 'title2',
                'underTitle' => 'under_title2',
                'ageRestriction' => '+0',
                'state' => 0,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg',
            ],
            3 => [
                'id' => 3,
                'mir_id' => 3,
                'hd_id' => 3,
                'category' => 'category3',
                'name' => 'name3',
                'title' => 'title3',
                'underTitle' => 'under_title3',
                'ageRestriction' => '+0',
                'state' => 0,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg',
            ],
            4 => [
                'id' => 4,
                'mir_id' => 4,
                'hd_id' => 4,
                'category' => 'category4',
                'name' => 'name4',
                'title' => 'title4',
                'underTitle' => 'under_title4',
                'ageRestriction' => '+0',
                'state' => 0,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg',
            ],
            5 => [
                'id' => 5,
                'mir_id' => 5,
                'hd_id' => 5,
                'category' => 'category5',
                'name' => 'name5',
                'title' => 'title5',
                'underTitle' => 'under_title5',
                'ageRestriction' => '+0',
                'state' => 0,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Gull_portrait_ca_usa.jpg/300px-Gull_portrait_ca_usa.jpg',
            ],
        ];
    }
}
