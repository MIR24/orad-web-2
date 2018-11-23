<?php

if (! function_exists('auto_asset')) {
    /**
     * Generate an asset path for the application depending on environment.
     *
     * @param  string  $path
     * @return string
     */
    function auto_asset($path)
    {
        return asset($path, config('app.secure'));
    }
}

if (! function_exists('load_strings')) {
    /**
     * Generate an asset path for the application depending on environment.
     *
     * @param  mixed  $resourse
     * @return mixed
     */
    function load_strings($resourse)
    {
        if ($resourse instanceof App\Contracts\CategoryWithStrings) {
            $resourse->strings = $resourse->strings()->get()->implode('text', config('strings.eol_symbol'));
            return $resourse;
        }
        if ($resourse instanceof Illuminate\Database\Eloquent\Collection) {
            return $resourse->each(function ($item) {
                if ($item instanceof App\Contracts\CategoryWithStrings) {
                    return $item->strings = $item->strings()->get()->implode('text', config('strings.eol_symbol'));
                }
            });
        }
    }
}
