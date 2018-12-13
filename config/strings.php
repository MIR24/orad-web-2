<?php

return [

    /*
    |--------------------------------------------------------------------------
    | EOL symbol for strings in text
    |--------------------------------------------------------------------------
    |
    | EOL symbol, which application will use to convert strings in text.
    |
    */

    'eol_symbol' => env('STRINGS_EOL_SYMBOL', PHP_EOL),

    /*
    |--------------------------------------------------------------------------
    | Alowed symbols
    |--------------------------------------------------------------------------
    |
    | Alowed symbols for strings in text.
    |
    */

    'alowed_symbols' => env('STRINGS_ALOWED_SYMBOLS', '/^[a-zA-Zа-яёА-ЯЁ0-9._,!?:;\'"+\-*=%^#№&\\<>«»$\s]+$/iu'),

];
