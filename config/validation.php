<?php

return [

    'citytimeshifts' => [
        'prefix' => 'data.',
        'fields' => [
            'city' => 'required|string|max:255',
            'timeshift' => 'required|numeric',
        ],
    ],

    'currencyrates' => [
        'prefix' => 'data.',
        'fields' => [
            'val1' => 'required|string|max:255',
            'val2' => 'required|string|max:255',
            'dir' => 'required|integer',
            'value' => 'required|numeric',
        ],
    ],

    'eventcountdowns' => [
        'prefix' => 'data.',
        'fields' => [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'happen_at' => 'required|date',
        ],
    ],

    'hotnews' => [
        'prefix' => 'data.',
        'fields' => [
            'text' => 'required|string|max:255',
            'strings' => 'nullable|string|regex:{%strings.alowed_symbols%}|not_regex:/.{{%strings.length.hotnews%},}/mu',
            'orbits' => 'array',
        ],
    ],

    'newsbars' => [
        'prefix' => 'data.',
        'fields' => [
            'text' => 'required|string|max:255',
            'strings' => 'nullable|string|regex:{%strings.alowed_symbols%}|not_regex:/.{{%strings.length.newsbars%},}/mu',
        ],
    ],

    'nowfurtherlaters' => [
        'prefix' => 'data.',
        'fields' => [
            'name' => 'required|string|max:255',
            'external_id' => 'required|integer',
            'path' => 'required|string|max:255',
        ],
    ],

    'orbits' => [
        'prefix' => 'data.',
        'fields' => [
            'name' => 'required|string|max:255',
        ],
    ],

    'photocategories' => [
        'prefix' => 'data.',
        'fields' => [
            'text' => 'required|string|max:255',
        ],
    ],

    'photos' => [
        'prefix' => 'data.',
        'fields' => [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'path' => 'required|string|max:17',
        ],
    ],

    'promocategories' => [
        'prefix' => 'data.',
        'fields' => [
            'text' => 'required|string|max:255',
        ],
    ],

    'promos' => [
        'prefix' => 'data.',
        'fields' => [
            'mir_id' => 'required|integer',
            'mirhd_id' => 'required|integer',
            'category_id' => 'required|integer',
            'age' => 'required|integer',
            'name' => 'required|string|max:255',
            'header' => 'required|string|max:255',
            'subheader' => 'required|string|max:255',
            'mode' => 'required|integer',
        ],
    ],

    'settings' => [
        'prefix' => 'data.',
        'fields' => [
            'param' => 'required|string|max:255',
            'desc' => 'required|string|max:255',
            'value' => 'required|string|max:255',
        ],
    ],

    'tabs' => [
        'prefix' => 'data.',
        'fields' => [
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:255',
            'position' => 'required|integer',
        ],
    ],

    'tickers' => [
        'prefix' => 'data.',
        'fields' => [
            'text' => 'required|string|max:255',
            'strings' => 'nullable|string|regex:{%strings.alowed_symbols%}|not_regex:/.{{%strings.length.tickers%},}/mu',
        ],
    ],

    'tops' => [
        'prefix' => 'data.',
        'fields' => [
            'text' => 'required|string|max:255',
            'strings' => 'nullable|string|regex:{%strings.alowed_symbols%}|not_regex:/.{{%strings.length.SINGLE_TOP_LENGTH%},}/mu',
        ],
    ],

    'users' => [
        'prefix' => 'data.',
        'fields' => [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ],
    ],

    'weatherforecasts' => [
        'prefix' => 'data.',
        'fields' => [
            'city' => 'required|string|max:70',
            'evening' => 'required|integer',
            'morning' => 'required|integer',
            'status' => 'required|string|max:70',
            'weather_type_id' => 'required|integer'
        ],
    ],

    'weatherforecastsliners' => [
        'prefix' => 'data.',
        'fields' => [
            'city' => 'required|string|max:70',
            'evening' => 'required|integer',
            'morning' => 'required|integer',
            'now' => 'required|integer',
            'status' => 'required|string|max:70',
            'weather_type_id' => 'required|integer'
        ],
    ],

    'weathertypes' => [
        'prefix' => 'data.',
        'fields' => [
            'type' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
        ],
    ],
];
