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
        $revManifestDecoded = json_decode(File::get(base_path('rev-manifest.json')));
        $urlExploded = explode('/', $path);
        $fileName = array_pop($urlExploded);

        if (isset($revManifestDecoded->{$fileName})) {
            array_push($urlExploded, $revManifestDecoded->{$fileName});
            return asset(implode('/', $urlExploded), config('app.secure'));
        } else {
            return asset($path, config('app.secure'));
        }
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

if (! function_exists('get_settings_hash')) {
    /**
     * Get app settings from cache or database.
     *
     * @return mixed
     */
    function get_settings_hash()
    {
        return Cache::remember('app_settings', config('cache.default_ttl'), function () {
            return Illuminate\Support\Facades\Hash::make(
                App\Setting::get()
            );
        });
    }
}

if (! function_exists('forget_settings_hash')) {
    /**
     * Get app settings from cache or database.
     *
     * @return bool
     */
    function forget_settings_hash()
    {
        return Cache::forget('app_settings');
    }
}

if (! function_exists('get_git_version')) {
    /**
     * Getting application git branch version.
     *
     * @return string
     */
    function get_git_version()
    {
        return trim(exec('git log --pretty="%h" -n1 HEAD'));
    }
}
