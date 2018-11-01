<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dummy'); // return view('welcome');
});


Route::get('/test/tops', 'TestController@getTops');
Route::get('/test/newsbar', 'TestController@getNewsbar');
Route::get('/test/expedited', 'TestController@getExpedited');
Route::get('/test/currency', 'TestController@getCurrency');
Route::get('/test/weatherlive', 'TestController@getWeather');
Route::get('/test/timeshift', 'TestController@getTimeShift');
Route::get('/test/countdown', 'TestController@getCountdown');
Route::get('/test/promo', 'TestController@getPromo');
Route::get('/test/icons', 'TestController@getIcons');

Auth::routes();
