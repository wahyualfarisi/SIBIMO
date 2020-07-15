<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $level = $request->session()->get('level');
        return view('dashboard.'.$level);   
    }
}
