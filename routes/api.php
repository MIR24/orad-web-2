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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('citytimeshifts-collections', 'API\CityTimeshiftController@storeMultiple');
Route::patch('citytimeshifts-collections', 'API\CityTimeshiftController@patchMultiple');
Route::post('currencyrates-collections', 'API\CurrencyRateController@storeMultiple');
Route::patch('currencyrates-collections', 'API\CurrencyRateController@patchMultiple');
Route::post('eventcountdowns-collections', 'API\EventCountdownController@storeMultiple');
Route::patch('eventcountdowns-collections', 'API\EventCountdownController@patchMultiple');
Route::post('hotnews-collections', 'API\HotNewsController@storeMultiple');
Route::patch('hotnews-collections', 'API\HotNewsController@patchMultiple');
Route::post('newsbars-collections', 'API\NewsbarController@storeMultiple');
Route::patch('newsbars-collections', 'API\NewsbarController@patchMultiple');
Route::post('tickers-collections', 'API\TickerController@storeMultiple');
Route::patch('tickers-collections', 'API\TickerController@patchMultiple');
Route::post('tops-collections', 'API\TopController@storeMultiple');
Route::patch('tops-collections', 'API\TopController@patchMultiple');
Route::post('tabs-collections', 'API\TabController@storeMultiple');
Route::patch('tabs-collections', 'API\TabController@patchMultiple');
Route::post('settings-collections', 'API\SettingController@storeMultiple');
Route::patch('settings-collections', 'API\SettingController@patchMultiple');
Route::post('weatherforecasts-collections', 'API\WeatherForecastController@storeMultiple');
Route::patch('weatherforecasts-collections', 'API\WeatherForecastController@patchMultiple');
Route::post('weatherforecastsliner-collections', 'API\WeatherForecastLinerController@storeMultiple');
Route::patch('weatherforecastsliner-collections', 'API\WeatherForecastLinerController@patchMultiple');
Route::post('weathertypes-collections', 'API\WeatherTypeController@storeMultiple');
Route::patch('weathertypes-collections', 'API\WeatherTypeController@patchMultiple');
Route::post('photos-collections', 'API\PhotoController@storeMultiple');
Route::patch('photos-collections', 'API\PhotoController@patchMultiple');
Route::post('photocategories-collections', 'API\PhotoCategoryController@storeMultiple');
Route::patch('photocategories-collections', 'API\PhotoCategoryController@patchMultiple');
Route::post('promos-collections', 'API\PromoController@storeMultiple');
Route::patch('promos-collections', 'API\PromoController@patchMultiple');
Route::post('promocategories-collections', 'API\PromoCategoryController@storeMultiple');
Route::patch('promocategories-collections', 'API\PromoCategoryController@patchMultiple');
Route::post('orbits-collections', 'API\OrbitController@storeMultiple');
Route::patch('orbits-collections', 'API\OrbitController@patchMultiple');

Route::apiResources([
    'citytimeshifts' => 'API\CityTimeshiftController',
    'currencyrates' => 'API\CurrencyRateController',
    'eventcountdowns' => 'API\EventCountdownController',

    // Пары категория+строка
    'hotnews' => 'API\HotNewsController',
    'newsbars' => 'API\NewsbarController',
    'tickers' => 'API\TickerController',
    'tops' => 'API\TopController',
    //----------------------

    'tabs' => 'API\TabController',
    'settings' => 'API\SettingController',
    'weatherforecasts' => 'API\WeatherForecastController',
    'weatherforecastsliner' => 'API\WeatherForecastLinerController',
    'weathertypes' => 'API\WeatherTypeController',
    'photos' => 'API\PhotoController',
    'photocategories' => 'API\PhotoCategoryController',
    'promos' => 'API\PromoController',
    'promocategories' => 'API\PromoCategoryController',
    'orbits' => 'API\OrbitController',
]);
