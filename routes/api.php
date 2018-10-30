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

Route::apiResource('citytimeshifts', 'API\CityTimeshiftController');
Route::apiResource('currencyrates', 'API\CurrencyRateController');
Route::apiResource('eventcountdowns', 'API\EventCountdownController');

// Пары категория+строка
Route::apiResource('hotnews', 'API\HotNewsController');
Route::apiResource('newsbars', 'API\NewsbarController');
Route::apiResource('tickers', 'API\TickerController');
Route::apiResource('tops', 'API\TopController');
//----------------------

Route::apiResource('tabs', 'API\TabController');
Route::apiResource('settings', 'API\SettingController');
Route::apiResource('weatherforecasts', 'API\WeatherForecastController');
Route::apiResource('weathertypes', 'API\WeatherTypeController');
Route::apiResource('photos', 'API\PhotoController');
Route::apiResource('photocategories', 'API\PhotoCategoryController');
Route::apiResource('promos', 'API\PromoController');
Route::apiResource('promocategories', 'API\PromoCategoryController');
