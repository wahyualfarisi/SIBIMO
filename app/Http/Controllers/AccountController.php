<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.data');
    }

    public function add()
    {
        return view('account.add');
    }

    public function tu()
    {

    }

    public function kaprodi()
    {
        
    }
}
