<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\Jurusan;
use App\models\Mahasiswa;
use App\models\Account;
use App\models\Pembimbing;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
        if(auth('mahasiswa')->user() ){
            
            return response()->json([
                'message' => 'Get Dashboard Mahasiswa',
                'level'   => 'Mahasiswa',
                'status'  => 200,
                'info_user'    => auth('mahasiswa')->user()
            ]);

        }else if(auth('account')->user() ){

            switch(auth('account')->user()->level){
                case 'TU':
                    $jurusan = Jurusan::all();
                    $mahasiswa = Mahasiswa::all()->count();
                    $dosen  = Account::where('level','DOSEN')->get()->count();
                    return response()->json([
                        'message' => 'Get Dashboad',
                        'level'   => auth('account')->user()->level,
                        'status'  => 200,
                        'info_user'    => auth('account')->user(),
                        'results' => [
                            'jurusan' => $jurusan,
                            'mahasiswa' => $mahasiswa,
                            'dosen' => $dosen
                        ]
                    ]);
                break;

                case 'KAPRODI':
                    return response()->json([
                        'message' => 'Get Dashboard Mahasiswa',
                        'level'   => auth('account')->user()->level,
                        'status'  => 200,
                        'info_user'    => auth('account')->user()
                    ]);        
                break;

                case 'DOSEN':
                    return response()->json([
                        'message' => 'Get Dashboard Mahasiswa',
                        'level'   => auth('account')->user()->level,
                        'status'  => 200,
                        'info_user'    => auth('account')->user()
                    ]);
                break;
            }

        }else{
            return response()->json([
                'status'   => false,
                'message'  => 'Permission denied'
            ], 401);
        }
    }
}
