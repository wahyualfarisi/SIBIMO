<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FakultasController extends Controller
{
    public function index(Request $request)
    {
        $level = $request->session()->get('level');

        if(!in_array($level, ['tu','kaprodi','dosen'] ) ) {
            return  view('error.permission_denied');
        }else{
            return view('fakultas.data');
        }
    }
}
