<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AktifitasController extends Controller
{
    public function index(Request $request)
    {
        return view('aktifitas.data');
    }

    public function aktifitas(Request $request, $id )
    {
        $data['id_bimbingan'] = $id;
        return view('aktifitas.detail', $data);
    }

}
