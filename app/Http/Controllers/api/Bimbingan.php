<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\models\Bimbingan as BimbinganModel;
use App\models\Pembimbing;


class Bimbingan extends Controller
{
    public function store(Request $request)
    {
        if( auth('account')->user() ) {
            return response()->json([
                'status'   => false,
                'message'  => 'Permission denied'
            ], 401);
        }

        $validated = Validator::make($request->all(), [
            'id_pembimbing' => 'required',
            'bab'           => 'required|in:BAB 1, BAB 2, BAB 3, BAB 4, BAB 5',
            'file'          => 'required'
        ]);

        if( $validated->fails() )
        return response()->json([
            'status'   => false,
            'message'  => 'fields required',
            'errors' => $validated->errors()
        ], 422);

        
        $pembimbing = Pembimbing::findOrFail($request->id_pembimbing);
        
        $mahasiswa  = auth('mahasiswa')->user();

        try{
            $file = $request->file('file');

            $name = $file->getClientOriginalName();

            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            $filenametoStore = $mahasiswa->nim.'_'.date('Y-m-d').'_'.time().'.'.$filename.'.'.$extension;

            $file->storeAs('public/file/'.$mahasiswa->nim.'/', $filenametoStore);
        
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ], 500);
        }

        try{
            $bimbingan = new BimbinganModel;
            $bimbingan->id_bimbingan = Uuid::uuid4();
            $bimbingan->id_mahasiswa = auth('mahasiswa')->user()->id_mahasiswa;
            $bimbingan->id_pembimbing = $request->id_pembimbing;
            $bimbingan->bab = $request->bab;
            $bimbingan->tanggal_bimbingan = date('Y-m-d');
            $bimbingan->deskripsi_bimbingan = $request->deskripsi_bimbingan;
            $bimbingan->file = $filenametoStore;
            $bimbingan->status = 'progress';

            
            $bimbingan->save();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status'   => true,
            'message'  => 'Bimbingan dimulai',
            'results'  => $bimbingan
        ]);

    }

    public function current_activity(Request $request)
    {

    }

    public function history(Request $request)
    {
        
    }
}
