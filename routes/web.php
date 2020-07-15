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
    Route::get('/account', 'AccountController@index');
    Route::get('/mahasiswa','MahasiswaController@index');
    Route::get('/laporan','LaporanController@index');
    Route::get('/notifikasi', 'NotificationController@index');
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


