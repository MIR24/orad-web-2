<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Searchable models and columns
    |--------------------------------------------------------------------------
    |
    | Searchable models and columns.
    |
    */

    'photo' => [
        'columns' => ['Name', 'Title']
    ],

    'promo' => [
        'columns' => ['name', 'header', 'subheader', 'age']
    ],

    'query' => [
        'name' => 'q'
    ]

];
