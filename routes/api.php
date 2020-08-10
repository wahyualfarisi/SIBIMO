<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication
//route login in the web routes 

Route::get('verify', 'api\Auth@verify');
Route::post('logout', 'api\Auth@logout');
Route::post('test', 'api\Auth@test');

Route::get('dashboard', 'api\Dashboard@index');

//photo route
Route::get('foto/account/{filename}', 'api\PhotoApi@account_foto');
Route::get('foto/mahasiswa/{filename}', 'api\PhotoApi@mahasiswa_foto');

//file 
Route::get('file/{nim}/{filename}', 'api\PhotoApi@file_bimbingan');
Route::get('file/{nim}/catatan/{filename}', 'api\PhotoApi@catatan');

//account api
Route::apiResource('jurusan', 'api\Jurusan')->middleware('auth:account');
Route::post('/jurusan/{id_jurusan}/update_kaprodi', 'api\Jurusan@updateKaprodi');

Route::apiResource('account', 'api\Account')->middleware('auth:account');
Route::post('account/update/avatar', 'api\Account@updateAvatar')->middleware('auth:account');

//pembimbing
Route::apiResource('pembimbing', 'api\Pembimbing')->middleware('auth:account');
Route::post('pembimbing/{id_pembimbing}/update_pembimbing', 'api\Pembimbing@update_pembimbing');

Route::get('mahasiswa', 'api\Mahasiswa@index')->middleware('auth:account');
Route::post('mahasiswa', 'api\Mahasiswa@store')->middleware('auth:account');
Route::get('mahasiswa/{id_mahasiswa}', 'api\Mahasiswa@show')->middleware('auth:account');
Route::put('mahasiswa/{id_mahasiswa}', 'api\Mahasiswa@update');
Route::post('mahasiswa/reset/{id_mahasiswa}', 'api\Mahasiswa@resetPassword');
Route::get('mahasiswa/material/form', 'api\Mahasiswa@material_mhs_form')->middleware('auth:account');
Route::post('mahasiswa/update/foto', 'api\Mahasiswa@updateFoto');
//mahasiswa api

Route::post('judul/add', 'api\Judul@store');
Route::post('judul/delete/{id_judul}', 'api\Judul@delete');
Route::post('judul/manage_judul', 'api\Judul@manageJudul');

//bimbingan
Route::post('bimbingan/create', 'api\Bimbingan@store');
Route::get('bimbingan/current', 'api\Bimbingan@current_activity');
Route::get('bimbingan/history', 'api\Bimbingan@history');
Route::get('bimbingan/{id_bimbingan}', 'api\Bimbingan@detail');

//Diskusi
Route::post('diskusi/create', 'api\Diskusi@create');

Route::post('catatan/create', 'api\Catatan@create');

