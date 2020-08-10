<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use App\models\Bimbingan as BimbinganModel;
use App\models\Pembimbing;
use App\models\LembarBimbingan;


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

        if( auth('account')->user() ){
            
            if(auth('account')->user()->level === 'TU'){
                return response()->json([
                    'status'   => false,
                    'message'  => 'Permission denied'
                ], 401);
            }

            $dospem = auth('account')->user();

            return response()->json([
                'status'   => true,
                'message'  => 'Current Activity',
                'type' => 'Dospem',
                'results' => $dospem
                            ->get_bimbingan()
                            ->with('get_mahasiswa')
                            ->where('status', 'progress')
                            ->get()
            ]);
        }


        if( auth('mahasiswa')->user() ) {

            $bimbingan = BimbinganModel::with('get_account','get_pembimbing','get_mahasiswa')->where([
                ['status', 'progress'],
                ['id_mahasiswa', auth('mahasiswa')->user()->id_mahasiswa]
            ])->get();

            return response()->json([
                'status'   => true,
                'message'  => 'Current Activity',
                'type'     => 'Mahasiswa',
                'results'  => $bimbingan
            ]);
        }
    }

    public function detail(Request $request, $id_bimbingan)
    {
        $bimbingan = BimbinganModel::findOrFail($id_bimbingan);

        try{
            $bimbingan = BimbinganModel::with([
                'get_diskusi.get_dospem',
                'get_diskusi.get_mahasiswa',
                'get_catatan',
                'get_lembar_bimbingan',
                'get_account',
                'get_pembimbing',
                'get_mahasiswa'
            ])->where('id_bimbingan', $bimbingan->id_bimbingan)->first();


            return response()->json([
                'status'   => true,
                'message'  => 'Fetch detail bimbingan',
                'results'  => $bimbingan
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ], 500);
        }
    }

    public function history(Request $request)
    {
        if( auth('account')->user() ){
            if(auth('account')->user()->level === 'TU'){
                return response()->json([
                    'status'   => false,
                    'message'  => 'Permission denied'
                ], 401);
            }

            $dospem = auth('account')->user();

            return response()->json([
                'status'   => true,
                'message'  => 'History Activity',
                'type' => 'Dospem',
                'results' => $dospem
                            ->get_bimbingan()
                            ->where('status', 'selesai')
                            ->get()
            ]);
        }

        if( auth('mahasiswa')->user() ) {
            $bimbingan = BimbinganModel::where([
                ['status', 'selesai'],
                ['id_mahasiswa', auth('mahasiswa')->user()->id_mahasiswa]
            ])->get();


            return response()->json([
                'message' => 'History Activity',
                'type'    => 'Mahasiswa',
                'status'  => true,
                'results' => $bimbingan
            ]);
        }
    }

    public function tutup_bimbingan(Request $request)
    {
        if(!in_array(auth('account')->user()->level, ['DOSEN','KAPRODI'] ) )
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        $validated = Validator::make($request->all(), [
            'id_bimbingan' => 'required',
            'status'       => 'required|in:revisi,acc',
            'paraf'        => 'required'
        ]);

        if( $validated->fails() ) {
            return response()->json([
                'status'   => false,
                'message'  => 'Fields Required',
                'errors'   => $validated->errors()
            ], 422);
        }

        $bimbingan = BimbinganModel::findOrFail($request->id_bimbingan);

        if($bimbingan->status === 'selesai'){
            return response()->json([
                'status'   => false,
                'message'  => 'Bimbingan sudah selesai'
            ]);
        }


        try{
            $file = $request->file('paraf');

            $name = $file->getClientOriginalName();

            $filename = pathinfo($name, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            $filenametoStore = $filename.'_'.time().'.'.$extension;

            $file->storeAs('public/ttd/',$filenametoStore);
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ], 500);
        }

        DB::beginTransaction();
        try{
            $bimbingan->status = 'selesai';
            $bimbingan->update();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ], 500);
        }


        try{
            $lembar_bimbingan = new LembarBimbingan;
            $lembar_bimbingan->id_bimbingan = $bimbingan->id_bimbingan;
            $lembar_bimbingan->id_pembimbing = $bimbingan->id_pembimbing;
            $lembar_bimbingan->permasalahan = $bimbingan->bab;

            if($request->status === 'revisi'){
                $lembar_bimbingan->revisi = 'YA';
                $lembar_bimbingan->acc    = 'TIDAK';
            }else if($request->status === 'acc'){
                $lembar_bimbingan->revisi = 'TIDAK';
                $lembar_bimbingan->acc    = 'YA';
            }
            $lembar_bimbingan->paraf = $filenametoStore;

            $lembar_bimbingan->save();


        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ]);
        }

        DB::commit();
        return response()->json([
            'status'   => true,
            'message'  => 'Tutup bimbingan'
        ]);


    }

}
