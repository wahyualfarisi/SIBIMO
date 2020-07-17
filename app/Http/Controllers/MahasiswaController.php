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

    public function detail()
    {
        return view('mahasiswa.detail');
    }
}
