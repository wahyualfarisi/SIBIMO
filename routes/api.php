<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication
//route login in the web routes 

Route::get('verify', 'api\Auth@verify');
Route::post('logout', 'api\Auth@logout');
Route::post('test', 'api\Auth@test');

Route::get('dashboard', 'api\Dashboard@index');