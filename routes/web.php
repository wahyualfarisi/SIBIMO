<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//Login 
// your routes here
Route::redirect('/', '/login');
Route::get('/login', 'AuthController@login');
Route::post('/authorization_process', 'AuthController@authorizationProcess');
Route::get('/authorization_clear', 'AuthController@authorizationClear');

Route::get('/main', 'MainController@index');


//testing session
Route::get('/session', function(Request $request) {
    return $request->session()->get('level');
});

Route::get('/store-session', function(Request $request) {
    return $request->session()->put('key', 'this is value');
});
//testing session


