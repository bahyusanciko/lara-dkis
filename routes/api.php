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

        Route::get('getlistapps', 'Api\ActivityController@getListApps');

        Route::post('lupa-password', 'Api\ActivityController@LupaPassword');
        Route::post('laporan-jaringan', 'Api\ActivityController@LaporJaringan');
        Route::post('layanan-email', 'Api\ActivityController@email');
        Route::post('layanan-aplikasi', 'Api\ActivityController@aplikasi');
        Route::post('layanan-cloud', 'Api\ActivityController@akun_cloud');
        Route::post('layanan-lpse', 'Api\ActivityController@LPSE');
        Route::post('layanan-subdomain', 'Api\ActivityController@SubDomain');

        Route::get('status-laporan/{id}','Api\LaporanController@index_user');
        Route::get('status-laporan/lpse','Api\LaporanController@stat_lpse_user');
        Route::get('status-laporan/subdomain','Api\LaporanController@stat_subdomain_user');
        Route::get('status-laporan/akun-cloud','Api\LaporanController@stat_akun_cloud_user');
        Route::get('status-laporan/jaringan','Api\LaporanController@stat_jaringan_user');
        Route::get('status-laporan/email','Api\LaporanController@stat_email_user');
        Route::get('status-laporan/aplikasi','Api\LaporanController@stat_aplikasi_user');
        Route::get('status-laporan/lupa-password','Api\LaporanController@stat_lupa_password_user');

    });
