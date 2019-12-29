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

Route::post('login', 'AuthController@login')->name('login');
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    
    
    Route::post('signup', 'AuthController@signup')->name('signup');
    Route::post('logout', 'AuthController@logout');
    
   

});

Route::group(['middleware' => 'api:auth'],function(){

        Route::apiResource('customers', 'CustomerController');
        Route::apiResource('actions', 'ActionController');
   

});
 