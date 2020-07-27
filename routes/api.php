<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication
//route login in the web routes 

Route::get('verify', 'api\Auth@verify');
Route::post('logout', 'api\Auth@logout');
Route::post('test', 'api\Auth@test');

Route::get('dashboard', 'api\Dashboard@index');



Route::apiResource('jurusan', 'api\Jurusan')->middleware('auth:account');
Route::post('/jurusan/{id_jurusan}/update_kaprodi', 'api\Jurusan@updateKaprodi');

Route::apiResource('account', 'api\Account')->middleware('auth:account');
Route::apiResource('pembimbing', 'api\Pembimbing')->middleware('auth:account');

Route::get('mahasiswa', 'api\Mahasiswa@index')->middleware('auth:account');
Route::post('mahasiswa', 'api\Mahasiswa@store')->middleware('auth:account');
Route::get('mahasiswa/{id_mahasiswa}', 'api\Mahasiswa@show')->middleware('auth:account');
Route::get('mahasiswa/material/form', 'api\Mahasiswa@material_mhs_form')->middleware('auth:account');