<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KartuBimbinganController extends Controller
{
    public function index(Request $request, $encrypt_id )
    {
        $data['encrypt_id'] = $encrypt_id;
        return view('report.lembar_bimbingan', $data);
    }
}
