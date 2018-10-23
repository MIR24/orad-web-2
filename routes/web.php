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

Auth::routes();
