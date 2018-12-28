<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Url Query Keys
    |--------------------------------------------------------------------------
    |
    | Array of keys to find in url query.
    |
    */

    'keys' => [
        'search' => env('URL_KEYS_SEARCH', 'q'),
        'limit' => env('URL_KEYS_LIMIT', 'limit'),
        'offset' => env('URL_KEYS_OFFSET', 'offset'),
    ],

];
