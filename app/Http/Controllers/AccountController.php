<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.dosen');
    }

    public function add()
    {
        return view('account.add');
    }

    public function tu()
    {
        return view('account.tu');
    }

    public function kaprodi()
    {
        return view('account.kaprodi');
    }
}
