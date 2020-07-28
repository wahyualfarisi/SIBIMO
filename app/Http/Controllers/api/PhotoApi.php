<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PhotoApi extends Controller
{
    public function account_foto($filename)
    {
        $path = public_path().'/storage/foto/account/'.$filename;
        return Response::download($path);
    }


    public function mahasiswa_foto($filename)
    {
        $path = public_path().'/storage/foto/mahasiswa/'.$filename;
        return Response::download($path);
    }
}
