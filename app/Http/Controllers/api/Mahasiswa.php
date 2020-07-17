<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\models\Mahasiswa as MahasiswaModel;
use App\models\JudulSkripsi;
use App\models\Pembimbing;
use App\models\Dospem;
use App\models\Jurusan;

class Mahasiswa extends Controller
{
    public function index(Request $request)
    {
        $data = MahasiswaModel::with('get_jurusan','get_judul_skripsi')->get();

        try{
            switch(auth('account')->user()->level)
            {
                case 'TU':
                    case 'DOSEN':
                        case 'KAPRODI':

                        return response()->json([
                            'status'   => true,
                            'message'  => 'Fetch all mahasiswa',
                            'results'  => $data
                        ]);
                break;
            }
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong, please try again'
            ]);
        }
    }

    public function store(Request $request)
    {
        if(!in_array(auth('account')->user()->level, ['TU'] ) )
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        $validate = Validator::make($request->all(), [
            'nim' => 'required',
            'nama_lengkap' => 'required',
            'email' => 'required',
            'id_jurusan' => 'required',
            'angkatan' => 'required',
            'judul_skripsi' => 'required',
            'pembimbing_1' => 'required',
            'pembimbing_2' => 'required'
        ]);

        if($validate->fails())
        return response()->json([
            'status'   => false,
            'message'  => 'Fields required',
            'errors'   => $validate->errors()
        ], 422);

        DB::beginTransaction();

        $check = MahasiswaModel::where('nim', $request->nim)->orWhere('email', $request->email)->first();
       
        if($check)
        return response()->json([
            'status'   => false,
            'message'  => 'NIM / Email Sudah ada'
        ]);

       
        try{
            $mahasiswa = new MahasiswaModel;
            $mahasiswa->nim = $request->nim;
            $mahasiswa->password = bcrypt($request->nim);
            $mahasiswa->nama_lengkap = $request->nama_lengkap;
            $mahasiswa->no_telp      = $request->no_telp;
            $mahasiswa->email = $request->email;
            $mahasiswa->id_jurusan = $request->id_jurusan;
            $mahasiswa->angkatan = $request->angkatan;
            $mahasiswa->save(); 
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status'   => false,
                'message'  => 'Failed to add mahasiswa'
            ], 500);
        }
       
        
        try{
            $judul_skripsi = new JudulSkripsi;
            $judul_skripsi->judul = strtoupper($request->judul_skripsi);
            $judul_skripsi->status = 'active';
            $judul_skripsi->deskripsi = $request->deskripsi;
            $judul_skripsi->id_mahasiswa = $mahasiswa->id_mahasiswa;
            $judul_skripsi->save();
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong , when add judul skripsi'
            ], 500);
        }

        //insert to pembimbing 1
        try{
            $pembimbing_1 = new Pembimbing;
            $pembimbing_1->id_dospem = $request->pembimbing_1;
            $pembimbing_1->id_mahasiswa = $mahasiswa->id_mahasiswa;
            $pembimbing_1->save();
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status'   => false,
                'message'  => 'Something wring , when add pembimbing 1'
            ], 500);
        }

        //insert into pembimbing 2
        try{
            $pembimbing_2 = new Pembimbing;
            $pembimbing_2->id_dospem = $request->pembimbing_2;
            $pembimbing_2->id_mahasiswa = $mahasiswa->id_mahasiswa;
            $pembimbing_2->save();
        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status'   => false,
                'message'  => 'Something wring , when add pembimbing 2'
            ], 500);
        }


        DB::commit();
        return response()->json([
            'status'   => true,
            'message'  => 'Success add mahasiswa',
            'results'  => $mahasiswa
        ]);   
    }

    public function show(Request $request, $id_mahasiswa)
    {
        if(!in_array(auth('account')->user()->level, ['TU'] ) )
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        $data_mahasiswa = MahasiswaModel::with([
            'get_jurusan',
            'get_judul_skripsi',
            'get_pembimbing.get_dospem.getAccount'
        ])->findOrFail($id_mahasiswa);

        $histori_judul = JudulSkripsi::where('id_mahasiswa', $id_mahasiswa)->get();

        try{    
            return response()->json([
                'status'   => true,
                'message'  => 'Fetch detail mahasiswa',
                'results'  => [
                    'data_mahasiswa' => $data_mahasiswa,
                    'histori_judul'  => $histori_judul
                ]
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong, when fetch detail mahasiswa'
            ], 500);
        }

    
    }

    public function material_mhs_form(Request $request)
    {
        if(!in_array(auth('account')->user()->level, ['TU'] ) )
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        try{
            return response()->json([
                'status'   => true,
                'message'  => 'Fetch material form add mahasiswa',
                'results'  => [
                    'jurusan' => Jurusan::all(),
                    'dospem'  => Dospem::with('getAccount')->get()
                ]
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong, please try again'
            ], 500);
        }

        
    }


}
