<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Authentication
Route::post('login', 'api\Auth@login');

Route::get('verify', 'api\Auth@verify');
Route::post('logout', 'api\Auth@logout');