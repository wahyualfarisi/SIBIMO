<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{

    public function index(Request $request)
    {
        $level = $request->session()->get('level');
        $login = $request->session()->get('login');

        if($login){
            return view('main.'.$level);
        }

        return redirect('/login');
    }
}
