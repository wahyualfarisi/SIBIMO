<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PlagiatismeController extends Controller
{
    public function index(Request $request)
    {
        return view('plagiatisme.data');
    }
}
