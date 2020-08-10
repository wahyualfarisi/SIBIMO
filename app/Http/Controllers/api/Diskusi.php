<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\models\DiskusiBimbingan as DiskusiModel;
use App\models\Bimbingan;

class Diskusi extends Controller
{
    public function create( Request $request )
    {
        $validated = Validator::make($request->all(), [
            'pesan' => 'required',
            'id_bimbingan' => 'required'
        ]);

        if( $validated->fails() )
        return response()->json([
            'status' => false,
            'message'  => 'Fields Required',
            'error' => $validated->errors()
        ], 422);

        $id_bimbingan = $request->id_bimbingan;

        $bimbingan = Bimbingan::findOrFail($id_bimbingan);


        if( auth('account')->user() ) {
            if( !in_array(auth('account')->user()->level, ['DOSEN','KAPRODI'] ) )
            return response()->json([
                'status'  => false,
                'message' => 'Permission denied'
            ], 401);

            $diskusi = new DiskusiModel;
            
            $diskusi->id_bimbingan  = $bimbingan->id_bimbingan;
            $diskusi->id_pembimbing = $bimbingan->id_pembimbing;
            $diskusi->id_mahasiswa  = null;
            $diskusi->pesan         = $request->pesan;

            $diskusi->save();

        }


        if( auth('mahasiswa')->user() ) {

            $diskusi = new DiskusiModel;

            $diskusi->id_bimbingan  = $bimbingan->id_bimbingan;
            $diskusi->id_pembimbing = null;
            $diskusi->id_mahasiswa  = $bimbingan->id_mahasiswa;
            $diskusi->pesan         = $request->pesan;
            
            $diskusi->save();
        }


        //results
        return response()->json([
            'status'   => true,
            'message'  => 'Success',
            'results'  => $diskusi
        ]);
    }
}
