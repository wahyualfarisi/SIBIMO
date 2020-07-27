<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        return view('jurusan.data');  
    }

    public function show($id)
    {
        $data['id'] = $id;
        
        return view('jurusan.detail', $data);
    }
}
