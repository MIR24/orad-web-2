<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('citytimeshifts', 'API\CityTimeshiftController@index')
    ->name('citytimeshifts.index');
Route::get('citytimeshifts/{id}', 'API\CityTimeshiftController@show')
    ->where(['id' => '[0-9]+'])
    ->name('citytimeshifts.show');

Route::get('currencyrates', 'API\CurrencyRateController@index')
    ->name('currencyrates.index');
Route::get('currencyrates/{id}', 'API\CurrencyRateController@show')
    ->where(['id' => '[0-9]+'])
    ->name('currencyrates.show');

Route::get('eventcountdowns', 'API\EventCountdownController@index')
    ->name('eventcountdowns.index');
Route::get('eventcountdowns/{id}', 'API\EventCountdownController@show')
    ->where(['id' => '[0-9]+'])
    ->name('eventcountdowns.show');

Route::get('weatherforecasts', 'API\WeatherForecastController@index')
    ->name('weatherforecasts.index');
Route::get('weatherforecasts/{id}', 'API\WeatherForecastController@show')
    ->where(['id' => '[0-9]+'])
    ->name('weatherforecasts.show');

Route::get('weatherforecastsliners', 'API\WeatherForecastLinerController@index')
    ->name('weatherforecastsliners.index');
Route::get('weatherforecastsliners/{id}', 'API\WeatherForecastLinerController@show')
    ->where(['id' => '[0-9]+'])
    ->name('weatherforecastsliners.show');

Route::get('weathertypes', 'API\WeatherTypeController@index')
    ->name('weathertypes.index');
Route::get('weathertypes/{id}', 'API\WeatherTypeController@show')
    ->where(['id' => '[0-9]+'])
    ->name('weathertypes.show');

Route::get('photos', 'API\PhotoController@index')
    ->name('photos.index');
Route::get('photos/{id}', 'API\PhotoController@show')
    ->where(['id' => '[0-9]+'])
    ->name('photos.show');

Route::get('photocategories', 'API\PhotoCategoryController@index')
    ->name('photocategories.index');
Route::get('photocategories/{id}', 'API\PhotoCategoryController@show')
    ->where(['id' => '[0-9]+'])
    ->name('photocategories.show');

Route::get('promos', 'API\PromoController@index')
    ->name('promos.index');
Route::get('promos/{id}', 'API\PromoController@show')
    ->where(['id' => '[0-9]+'])
    ->name('promos.show');

Route::get('promocategories', 'API\PromoCategoryController@index')
    ->name('promocategories.index');
Route::get('promocategories/{id}', 'API\PromoCategoryController@show')
    ->where(['id' => '[0-9]+'])
    ->name('promocategories.show');

Route::get('orbits', 'API\OrbitController@index')
    ->name('orbits.index');
Route::get('orbits/{id}', 'API\OrbitController@show')
    ->where(['id' => '[0-9]+'])
    ->name('orbits.show');

Route::get('hotnews', 'API\HotNewsController@index')
    ->name('hotnews.index');
Route::get('hotnews/{id}', 'API\HotNewsController@show')
    ->where(['id' => '[0-9]+'])
    ->name('hotnews.show');

Route::get('newsbars', 'API\NewsbarController@index')
    ->name('newsbars.index');
Route::get('newsbars/{id}', 'API\NewsbarController@show')
    ->where(['id' => '[0-9]+'])
    ->name('newsbars.show');

Route::get('tickers', 'API\TickerController@index')
    ->name('tickers.index');
Route::get('tickers/{id}', 'API\TickerController@show')
    ->where(['id' => '[0-9]+'])
    ->name('tickers.show');

Route::get('tops', 'API\TopController@index')
    ->name('tops.index');
Route::get('tops/{id}', 'API\TopController@show')
    ->where(['id' => '[0-9]+'])
    ->name('tops.show');

Route::group(['middleware' => ['auth']], function () {
    Route::get('users/{id}/permissions', 'API\UserController@showPermissions');

    Route::post('citytimeshifts', 'API\CityTimeshiftController@store')
        ->name('citytimeshifts.store');
    Route::put('citytimeshifts/{id}', 'API\CityTimeshiftController@update')
        ->where(['id' => '[0-9]+'])
        ->name('citytimeshifts.update');
    Route::delete('citytimeshifts/{id}', 'API\CityTimeshiftController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('citytimeshifts.destroy');

    Route::post('currencyrates', 'API\CurrencyRateController@store')
        ->name('currencyrates.store');
    Route::put('currencyrates/{id}', 'API\CurrencyRateController@update')
        ->where(['id' => '[0-9]+'])
        ->name('currencyrates.update');
    Route::delete('currencyrates/{id}', 'API\CurrencyRateController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('currencyrates.destroy');

    Route::post('eventcountdowns', 'API\EventCountdownController@store')
        ->name('eventcountdowns.store');
    Route::put('eventcountdowns/{id}', 'API\EventCountdownController@update')
        ->where(['id' => '[0-9]+'])
        ->name('eventcountdowns.update');
    Route::delete('eventcountdowns/{id}', 'API\EventCountdownController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('eventcountdowns.destroy');

    Route::post('weatherforecasts', 'API\WeatherForecastController@store')
        ->name('weatherforecasts.store');
    Route::put('weatherforecasts/{id}', 'API\WeatherForecastController@update')
        ->where(['id' => '[0-9]+'])
        ->name('weatherforecasts.update');
    Route::delete('weatherforecasts/{id}', 'API\WeatherForecastController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('weatherforecasts.destroy');

    Route::post('weatherforecastsliners', 'API\WeatherForecastLinerController@store')
        ->name('weatherforecastsliners.store');
    Route::put('weatherforecastsliners/{id}', 'APIWeatherForecastLinerController@update')
        ->where(['id' => '[0-9]+'])
        ->name('weatherforecastsliners.update');
    Route::delete('weatherforecastsliners/{id}', 'API\WeatherForecastLinerController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('weatherforecastsliners.destroy');

    Route::post('weathertypes', 'API\WeatherTypeController@store')
        ->name('weathertypes.store');
    Route::put('weathertypes/{id}', 'API\WeatherTypeController@update')
        ->where(['id' => '[0-9]+'])
        ->name('weathertypes.update');
    Route::delete('weathertypes/{id}', 'API\WeatherTypeController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('weathertypes.destroy');

    Route::post('photos', 'API\PhotoController@store')
        ->name('photos.store');
    Route::put('photos/{id}', 'API\PhotoController@update')
        ->where(['id' => '[0-9]+'])
        ->name('photos.update');
    Route::delete('photos/{id}', 'API\PhotoController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('photos.destroy');

    Route::post('photocategories', 'API\PhotoCategoryController@store')
        ->name('photocategories.store');
    Route::put('photocategories/{id}', 'API\PhotoCategoryController@update')
        ->where(['id' => '[0-9]+'])
        ->name('photocategories.update');
    Route::delete('photocategories/{id}', 'API\PhotoCategoryController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('photocategories.destroy');

    Route::post('promos', 'API\PromoController@store')
        ->name('promos.store');
    Route::put('promos/{id}', 'API\PromoController@update')
        ->where(['id' => '[0-9]+'])
        ->name('promos.update');
    Route::delete('promos/{id}', 'API\PromoController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('promos.destroy');

    Route::post('promocategories', 'API\PromoCategoryController@store')
        ->name('promocategories.store');
    Route::put('promocategories/{id}', 'API\PromoCategoryController@update')
        ->where(['id' => '[0-9]+'])
        ->name('promocategories.update');
    Route::delete('promocategories/{id}', 'API\PromoCategoryController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('promocategories.destroy');

    Route::post('orbits', 'API\OrbitController@store')
        ->name('orbits.store');
    Route::put('orbits/{id}', 'API\OrbitController@update')
        ->where(['id' => '[0-9]+'])
        ->name('orbits.update');
    Route::delete('orbits/{id}', 'API\OrbitController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('orbits.destroy');

    Route::post('hotnews', 'API\HotNewsController@store')
        ->name('hotnews.store');
    Route::put('hotnews/{id}', 'API\HotNewsController@update')
        ->where(['id' => '[0-9]+'])
        ->name('hotnews.update');
    Route::delete('hotnews/{id}', 'API\HotNewsController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('hotnews.destroy');

    Route::post('newsbars', 'API\NewsbarController@store')
        ->name('newsbars.store');
    Route::put('newsbars/{id}', 'API\NewsbarController@update')
        ->where(['id' => '[0-9]+'])
        ->name('newsbars.update');
    Route::delete('newsbars/{id}', 'API\NewsbarController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('newsbars.destroy');


    Route::post('tickers', 'API\TickerController@store')
        ->name('tickers.store');
    Route::put('tickers/{id}', 'API\TickerController@update')
        ->where(['id' => '[0-9]+'])
        ->name('tickers.update');
    Route::delete('tickers/{id}', 'API\TickerController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('tickers.destroy');


    Route::post('tops', 'API\TopController@store')
        ->name('tops.store');
    Route::put('tops/{id}', 'API\TopController@update')
        ->where(['id' => '[0-9]+'])
        ->name('tops.update');
    Route::delete('tops/{id}', 'API\TopController@destroy')
        ->where(['id' => '[0-9]+'])
        ->name('tops.destroy');

    Route::post('citytimeshifts-collections', 'API\CityTimeshiftController@storeMultiple')
        ->name('citytimeshifts-collections.storeMultiple');
    Route::patch('citytimeshifts-collections', 'API\CityTimeshiftController@patchMultiple')
        ->name('citytimeshifts-collections.patchMultiple');

    Route::post('currencyrates-collections', 'API\CurrencyRateController@storeMultiple')
        ->name('currencyrates-collections.storeMultiple');
    Route::patch('currencyrates-collections', 'API\CurrencyRateController@patchMultiple')
        ->name('currencyrates-collections.patchMultiple');

    Route::post('eventcountdowns-collections', 'API\EventCountdownController@storeMultiple')
        ->name('currencyrates-collections.storeMultiple');
    Route::patch('eventcountdowns-collections', 'API\EventCountdownController@patchMultiple')
        ->name('currencyrates-collections.patchMultiple');

    Route::post('hotnews-collections', 'API\HotNewsController@storeMultiple')
        ->name('hotnews-collections.storeMultiple');
    Route::patch('hotnews-collections', 'API\HotNewsController@patchMultiple')
        ->name('hotnews-collections.patchMultiple');

    Route::post('newsbars-collections', 'API\NewsbarController@storeMultiple')
        ->name('newsbars-collections.storeMultiple');
    Route::patch('newsbars-collections', 'API\NewsbarController@patchMultiple')
        ->name('newsbars-collections.patchMultiple');

    Route::post('tickers-collections', 'API\TickerController@storeMultiple')
        ->name('tickers-collections.storeMultiple');
    Route::patch('tickers-collections', 'API\TickerController@patchMultiple')
        ->name('tickers-collections.patchMultiple');

    Route::post('tops-collections', 'API\TopController@storeMultiple')
        ->name('tops-collections.storeMultiple');
    Route::patch('tops-collections', 'API\TopController@patchMultiple')
        ->name('tops-collections.patchMultiple');

    Route::post('tabs-collections', 'API\TabController@storeMultiple')
        ->name('tabs-collections.storeMultiple');
    Route::patch('tabs-collections', 'API\TabController@patchMultiple')
        ->name('tabs-collections.patchMultiple');

    Route::post('settings-collections', 'API\SettingController@storeMultiple')
        ->name('settings-collections.storeMultiple');
    Route::patch('settings-collections', 'API\SettingController@patchMultiple')
        ->name('settings-collections.patchMultiple');

    Route::post('weatherforecasts-collections', 'API\WeatherForecastController@storeMultiple')
        ->name('weatherforecasts-collections.storeMultiple');
    Route::patch('weatherforecasts-collections', 'API\WeatherForecastController@patchMultiple')
        ->name('weatherforecasts-collections.patchMultiple');

    Route::post('weatherforecastsliners-collections', 'API\WeatherForecastLinerController@storeMultiple')
        ->name('weatherforecastsliners-collections.storeMultiple');
    Route::patch('weatherforecastsliners-collections', 'API\WeatherForecastLinerController@patchMultiple')
        ->name('weatherforecastsliners-collections.patchMultiple');

    Route::post('weathertypes-collections', 'API\WeatherTypeController@storeMultiple')
        ->name('weathertypes-collections.storeMultiple');
    Route::patch('weathertypes-collections', 'API\WeatherTypeController@patchMultiple')
        ->name('weathertypes-collections.patchMultiple');

    Route::post('photos-collections', 'API\PhotoController@storeMultiple')
        ->name('photos-collections.storeMultiple');
    Route::patch('photos-collections', 'API\PhotoController@patchMultiple')
        ->name('photos-collections.patchMultiple');

    Route::post('photocategories-collections', 'API\PhotoCategoryController@storeMultiple')
        ->name('photocategories-collections.storeMultiple');
    Route::patch('photocategories-collections', 'API\PhotoCategoryController@patchMultiple')
        ->name('photocategories-collections.patchMultiple');

    Route::post('promos-collections', 'API\PromoController@storeMultiple')
        ->name('promos-collections.storeMultiple');
    Route::patch('promos-collections', 'API\PromoController@patchMultiple')
        ->name('promos-collections.patchMultiple');

    Route::post('promocategories-collections', 'API\PromoCategoryController@storeMultiple')
        ->name('promocategories-collections.storeMultiple');
    Route::patch('promocategories-collections', 'API\PromoCategoryController@patchMultiple')
        ->name('promocategories-collections.patchMultiple');

    Route::post('orbits-collections', 'API\OrbitController@storeMultiple')
        ->name('orbits-collections.storeMultiple');
    Route::patch('orbits-collections', 'API\OrbitController@patchMultiple')
        ->name('orbits-collections.patchMultiple');

    Route::apiResources([
        'users' => 'API\UserController',
        'settings' => 'API\SettingController',
    ]);

});
