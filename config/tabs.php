<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default state for tabs
    |--------------------------------------------------------------------------
    |
    | Tabs order - first -> last
    | jsClass (required) - used for translation and js initialization
    | seePremission (required) - see_TABNAME premission for tab
    |
    */

    'default' => [
        [
            'jsClass' => 'Tops',
            'seePremission' => 'see_tops',
        ],
        [
            'jsClass' => 'Newsbar',
            'seePremission' => 'see_newsbars',
        ],
        [
            'jsClass' => 'Expedited',
            'seePremission' => 'see_hotnews',
        ],
        [
            'jsClass' => 'CurrencyValues',
            'seePremission' => 'see_currencyrates',
        ],
        [
            'jsClass' => 'WeatherLive',
            'seePremission' => 'see_weatherforecasts',
        ],
        [
            'jsClass' => 'WeatherLiveLiner',
            'seePremission' => 'see_weatherforecastsliners',
        ],
        [
            'jsClass' => 'TimeShift',
            'seePremission' => 'see_citytimeshifts',
        ],
        [
            'jsClass' => 'Countdown',
            'seePremission' => 'see_eventcountdowns',
        ],
        [
            'jsClass' => 'Promo',
            'seePremission' => 'see_promos',
        ],
        [
            'jsClass' => 'PhotoUpload',
            'seePremission' => 'see_nowfurtherlaters',
        ],
        [
            'jsClass' => 'AdminControl',
            'seePremission' => 'see_admin_interface',
        ],
    ]
];