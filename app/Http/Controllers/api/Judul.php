<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\models\JudulSkripsi;
use App\models\Mahasiswa;

class Judul extends Controller
{
    public function store( Request $request)
    {
        if( !in_array( auth('account')->user()->level, ['TU'])  )
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);
        
        $validate = Validator::make($request->all(), [
            'id_mahasiswa' => 'required',
            'judul'        => 'required',
            'status'       => 'required|in:active,inactive'
        ]);

        if( $validate->fails() )
        return response()->json([
            'status'   => false,
            'message'  => 'Fields Required',
            'errors'   => $validate->errors() 
        ], 422);

        $mahasiswa = Mahasiswa::findOrFail($request->id_mahasiswa);

        try{
            switch($request->status)
            {
                case 'active':
                    JudulSkripsi::where('id_mahasiswa', $mahasiswa->id_mahasiswa)
                                ->update(['status' => 'inactive']);
                break;
            }

            //create 
            $judul = new JudulSkripsi;
            $judul->id_mahasiswa = $request->id_mahasiswa;
            $judul->judul = strtoupper($request->judul);
            $judul->deskripsi = $request->deskripsi;
            $judul->status = $request->status;

            $judul->save();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something went wrong',
                'error'    => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status'   => true,
            'message'  => 'Success add new judul',
            'results'  => $judul
        ]);



    }
}
