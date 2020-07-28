<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PembimbingController extends Controller
{
    public function index(Request $request)
    {
        return view('pembimbing.data');
    }

    public function show(Request $request)
    {
        return view('pembimbing.detail');
    }
}
