<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AktifitasController extends Controller
{
    public function index(Request $request)
    {
        return view('aktifitas.data');
    }
}
