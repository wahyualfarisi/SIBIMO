<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\models\Mahasiswa as MahasiswaModel;

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
}
