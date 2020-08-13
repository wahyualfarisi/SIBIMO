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

    public function file_bimbingan($nim, $filename)
    {
        $path = public_path().'/storage/file/'.$nim.'/'.$filename;
        return Response::download($path);
    }

    public function catatan($nim, $filename)
    {
        $path = public_path().'/storage/file/'.$nim.'/catatan/'.$filename;
        return Response::download($path);
    }

    public function tandatangan($filename)
    {
        $path = public_path().'/storage/ttd/'.$filename;
        return Response::download($path);
    }

    public function plagiatisme($filename)
    {
        $path = public_path().'/storage/file/plagiatisme/'.$filename;
        return Response::download($path);
    }


}
