<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function index()
    {
        return view('mahasiswa.data');
    }

    public function add()
    {
        return view('mahasiswa.add');
    }

    public function detail( $id_mahasiswa )
    {
        $data['id_mahasiswa'] = $id_mahasiswa;
        return view('mahasiswa.detail', $data);
    }
}
