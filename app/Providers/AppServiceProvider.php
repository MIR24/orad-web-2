<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Config;
use App\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(UrlGenerator $url)
    {
        if (config('app.secure')) {
            $url->formatScheme('https');
        }

        if (Schema::hasTable('Settings')) {
            foreach (Setting::all() as $setting) {
                Config::set('strings.length.'.$setting->param, $setting->value+1);
            }
        }

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (config('app.secure')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
