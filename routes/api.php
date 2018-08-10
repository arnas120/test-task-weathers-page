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

/* add new tab route */
Route::post('/add-tab', 'AddTabController@processForm');

/* get selected tab data from API */
Route::get('/get-tab-data/{cityName}', 'TabViewController@showTabData');
