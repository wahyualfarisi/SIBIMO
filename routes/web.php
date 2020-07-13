<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Login 
Route::redirect('/', '/login');
Route::get('/login', 'AuthController@login');

Route::get('/dashboard', 'DashboardController@index');


Route::get('/session', function(Request $request) {
    return $request->session()->all();
});

Route::get('/store-session', function(Request $request) {
    return $request->session()->put('key', 'this is value');
});


