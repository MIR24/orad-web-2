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
