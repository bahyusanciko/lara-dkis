<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

    Route::post('register', 'Api\UserController@register');
    Route::post('login', 'Api\UserController@authenticate');
    Route::post('forgot', 'Api\UserController@forgotPassword');

    Route::get('verfiyemail/{token}', 'Api\UserController@verfiyEmail');
    Route::get('forgotemail/{token}', 'Api\UserController@forgotEmail');
    Route::post('resetpassword', 'Api\UserController@resetPassword');

    // Route::get('scheduleHotspot', 'HotspotController@schedule');
    // Route::get('scheduleVpn', 'VpnController@schedule');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'Api\UserController@getAuthenticatedUser');
        Route::get('users', 'Api\UserController@index');
        Route::post('users', 'Api\UserController@updateProfile');
        Route::put('users/{id}', 'Api\UserController@changePassword');
        Route::get('users/{name}', 'Api\UserController@show');
        
    });
