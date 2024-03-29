<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Enums folder path
    |--------------------------------------------------------------------------
    |
    | Used by the package to fetch all enums in the given directory.
    |
    */

    'path' => app_path() . '/Enums',

    /*
    |--------------------------------------------------------------------------
    | Enum class prefix
    |--------------------------------------------------------------------------
    |
    | Used by the package when calling the different enums.
    |
    */

    'class_prefix' => 'App\\Enums\\',

    /*
    |--------------------------------------------------------------------------
    | Excluded enums
    |--------------------------------------------------------------------------
    |
    | Enums you wish to exclude from the frontend.
    |
    */

    'excluded' => [],

    /*
    |--------------------------------------------------------------------------
    | Using BenSampo enums
    |--------------------------------------------------------------------------
    |
    | Set to true if you're using BenSampo/laravel-enum.
    |
    */

    'is_ben_sampo' => false,
];
