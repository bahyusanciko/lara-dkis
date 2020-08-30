<?php

use Illuminate\Support\Facades\Route;
use App\Laporan;

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

// Home view
// Route::get('/', function(){
//     $lap = laporan::all();
//     dd($lap);
//     foreach($admin as $user){
//         dd($user->user);
//     }
// })->name('home');
Route::get('/', 'HomeController@index')->name('home');
Route::post('login-process','UsersController@Login');

// Akses User
Route::group(['middleware'=>['auth', 'verified']],function()
{
    // lupa password
    Route::get('lupa-password', 'HomeController@view_lupa_password');
    Route::post('lupa-password/upload-data-lupa-password', 'UsersController@LupaPassword');

    // laporan jaringan
    Route::get('laporan-jaringan', 'HomeController@view_laporan_jaringan');
    Route::post('laporan-jaringan/upload-data-lapor-jaringan', 'UsersController@LaporJaringan');

    // layanan pengajuan lpse
    Route::get('layanan-lpse', 'HomeController@view_lpse');
    Route::post('layanan-lpse/upload-data-layanan-lpse', 'UsersController@LPSE');

    // layanan pengajuan subdomain
    Route::get('layanan-subdomain', 'HomeController@view_subdomain');
    Route::post('layanan-subdomain/upload-data-subdomain', 'UsersController@SubDomain');

    // layanan pengajuan aplikasi
    Route::get('layanan-aplikasi', 'HomeController@view_aplikasi');
    Route::post('layanan-aplikasi/upload-data-aplikasi', 'UsersController@aplikasi');

    // layanan pengajuan email
    Route::get('layanan-email', 'HomeController@view_email');
    Route::post('layanan-email/upload-data-email', 'UsersController@email');

    // layanan pengajuan cloud
    Route::get('layanan-cloud', 'HomeController@view_cloud');
    Route::post('layanan-cloud/upload-data-cloud', 'UsersController@akun_cloud');


    // status laporan User
    Route::get('status-laporan','LaporanController@index_user');
    Route::get('status-laporan/lpse','LaporanController@stat_lpse_user');
    Route::get('status-laporan/subdomain','LaporanController@stat_subdomain_user');
    Route::get('status-laporan/akun-cloud','LaporanController@stat_akun_cloud_user');
    Route::get('status-laporan/jaringan','LaporanController@stat_jaringan_user');
    Route::get('status-laporan/email','LaporanController@stat_email_user');
    Route::get('status-laporan/aplikasi','LaporanController@stat_aplikasi_user');
    Route::get('status-laporan/lupa-password','LaporanController@stat_lupa_password_user');

    // Update no HP
    Route::post('updatenomor','UsersController@updateHp');

    // Ubah Password
    Route::post('ubahpassword','UsersController@ubah_password');

    // Admin
    Route::group(['middleware'=>['is_admin']],function()
    {
        // Admin dashboard
        Route::get('dashboardadmin', 'LaporanController@index_admin')->name('admin_dashboard');
        Route::get('dashboardadmin/lpse', 'LaporanController@stat_lpse_admin');
        Route::get('dashboardadmin/subdomain', 'LaporanController@stat_subdomain_admin');
        Route::get('dashboardadmin/akun-cloud', 'LaporanController@stat_akun_cloud_admin');
        Route::get('dashboardadmin/jaringan', 'LaporanController@stat_jaringan_admin');
        Route::get('dashboardadmin/email', 'LaporanController@stat_Email_admin');
        Route::get('dashboardadmin/aplikasi', 'LaporanController@stat_aplikasi_admin');
        Route::get('dashboardadmin/lupa-password', 'LaporanController@stat_lupa_password_admin');

        // edit laporan
        Route::post('dashboardadmin/edit_laporan', 'LaporanController@editStatusLaporan');
        Route::post('dashboardadmin/cLaporan', 'LaporanController@changeLaporan');

        // Ini testing dashboardadmin
        Route::get('dashboardadminnew', 'LaporanController@newIndex');

         // Admin Master
        Route::group(['middleware'=>['is_master']],function()
        {
            // bikin akun admin
            Route::get('dashboardadmin/pembuatan_akun', 'LaporanController@pembuatan_akun');
            Route::get('/adminlist','AdminController@index');
            Route::post('/insertAdmin','AdminController@insertAdmin');
            Route::post('/editAdmin','AdminController@editAdmin');
            Route::post('/deleteAdmin','AdminController@deleteAdmin');
            Route::view('/account', 'usersetting');
            Route::get('/aktifitas', 'AdminController@aktifitasAdmin');
        });
    });

});

// Testing
Route::view('faq', 'faq');
Route::get('cekdb','UsersController@debugdb');

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// // Password Reset Routes...
// Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
// Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
// Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
// Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::post('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
