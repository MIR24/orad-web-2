<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default state for tabs
    |--------------------------------------------------------------------------
    |
    | Tabs order - first -> last
    | jsClass (required) - used for translation and js initialization
    | active (at least one required) - witch tab content should be loaded first
    |
    */

    'default' => [
        [
            'jsClass' => 'Tops',
            'active' => true,
        ],
        [
            'jsClass' => 'Newsbar',
        ],
        [
            'jsClass' => 'Expedited',
        ],
        [
            'jsClass' => 'CurrencyValues',
        ],
        [
            'jsClass' => 'WeatherLive',
        ],
        [
            'jsClass' => 'TimeShift',
        ],
        [
            'jsClass' => 'Countdown',
        ],
        [
            'jsClass' => 'Promo',
        ],
        [
            'jsClass' => 'AdminControl',
        ],
    ]
];