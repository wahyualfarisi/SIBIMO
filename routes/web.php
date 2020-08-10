<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//-----------------------------------------------------------------------------------------
//Login 
// your routes here
Route::redirect('/', '/login');
Route::get('/login', 'AuthController@login');
Route::post('/authorization_process', 'AuthController@authorizationProcess');
Route::get('/authorization_clear', 'AuthController@authorizationClear');
//-----------------------------------------------------------------------------------------

//------------------------------MAIN-------------------------------------------------------
Route::group([
    'prefix' => 'main'
], function() {
    Route::get('/', 'MainController@index');
    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/fakultas', 'FakultasController@index');

    Route::get('/jurusan', 'JurusanController@index');
    Route::get('/jurusan/{id}', 'JurusanController@show');

    Route::get('/account/dosen', 'AccountController@index');
    Route::get('/account/tu', 'AccountController@tu');
    Route::get('/account/kaprodi', 'AccountController@kaprodi');
    Route::get('/account/add', 'AccountController@add');
    Route::get('/account/edit/{id_account}', 'AccountController@edit');

    Route::get('/aktifitas', 'AktifitasController@index');
    Route::get('/aktifitas/{id}', 'AktifitasController@aktifitas');
    Route::get('/aktifitas/{id}/close', 'AktifitasController@tutup_bimbingan');

    Route::get('/history', 'HistoryController@index');

    Route::get('/mahasiswa','MahasiswaController@index');
    Route::get('/mahasiswa/add', 'MahasiswaController@add');
    Route::get('/mahasiswa/{id}', 'MahasiswaController@detail');

    Route::get('/pembimbing', 'PembimbingController@index');
    Route::get('/pembimbing/{id_pembimbing}', 'PembimbingController@show');

    Route::get('/laporan','LaporanController@index');
    Route::get('/notifikasi', 'NotificationController@index');

    Route::get('/me', 'MeController@index');
});
//------------------------------END MAIN---------------------------------------------------



//testing session
Route::get('/session', function(Request $request) {
    return $request->session()->get('level');
});

Route::get('/store-session', function(Request $request) {
    return $request->session()->put('key', 'this is value');
});
//testing session


