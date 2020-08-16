<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\Jurusan;
use App\models\Mahasiswa;
use App\models\Account;
use App\models\Pembimbing;
use App\models\LembarBimbingan;

class Dashboard extends Controller
{
    public function index(Request $request)
    {
        if(auth('mahasiswa')->user() ){
            
            $pembimbing = Pembimbing::with([
                'get_bimbingan' => function($query) {
                    $query->where('status', 'selesai')->orderBy('created_at', 'ASC');
                },
                'get_bimbingan.get_lembar_bimbingan',
                'get_bimbingan.get_pembimbing',
                'get_account'
            ])->where('id_mahasiswa', auth('mahasiswa')->user()->id_mahasiswa)->get();

            $hasil_bimbingan = LembarBimbingan::with('get_bimbingan.get_pembimbing.get_account')->whereHas('get_bimbingan', function($query) {
                $query->where('id_mahasiswa', auth('mahasiswa')->user()->id_mahasiswa );
            })
            ->orderBy('created_at', 'ASC')
            ->get();

            return response()->json([
                'message' => 'Get Dashboard Mahasiswa',
                'level'   => 'Mahasiswa',
                'status'  => 200,
                'encrypt_id' => Encrypt(auth('mahasiswa')->user()->id_mahasiswa),
                'info_user'    => Mahasiswa::with([
                    'get_judul_skripsi',
                    'get_jurusan.get_kaprodi.get_account'
                ])->findOrFail( auth('mahasiswa')->user()->id_mahasiswa ),
                'history_bimbingan' => $pembimbing,
                'hasil_bimbingan' => $hasil_bimbingan
            ]);

        }else if(auth('account')->user() ){

            $mahasiswa_siap_sidang = Mahasiswa::
            whereHas('get_pembimbing.get_bimbingan.get_lembar_bimbingan', function($query) {
                $query->where([
                    ['permasalahan', 'DEMO PROGRAM'],
                    ['acc', 'YA']
                ]);
            });

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
                    $bimbingan = auth('account')->user()
                                    ->get_bimbingan()
                                    ->with('get_mahasiswa','get_lembar_bimbingan')
                                    ->limit(5)
                                    ->orderBy('created_at', 'DESC')
                                    ->get();

                    $mahasiswa_bimbingan = Mahasiswa::whereHas('get_pembimbing', function($query) {
                        $query->where('id_account', auth('account')->user()->id_account);
                    });

                    

                    return response()->json([
                        'message' => 'Get Dashboard Mahasiswa',
                        'level'   => auth('account')->user()->level,
                        'status'  => 200,
                        'info_user'    => auth('account')->user(),
                        'history_bimbingan' => $bimbingan,
                        'mahasiswa_bimbingan' => $mahasiswa_bimbingan->count(),
                        'siap_sidang' => $mahasiswa_siap_sidang->whereHas('get_pembimbing', function($query) {
                            $query->where('id_account', auth('account')->user()->id_account);
                        })->count()
                    ]);        
                break;

                case 'DOSEN':
                    $bimbingan = auth('account')->user()
                                    ->get_bimbingan()
                                    ->with('get_mahasiswa','get_lembar_bimbingan')
                                    ->limit(5)
                                    ->orderBy('created_at', 'DESC')
                                    ->get();

                    $mahasiswa_bimbingan = Mahasiswa::whereHas('get_pembimbing', function($query) {
                        $query->where('id_account', auth('account')->user()->id_account);
                    });

                    return response()->json([
                        'message' => 'Get Dashboard Mahasiswa',
                        'level'   => auth('account')->user()->level,
                        'status'  => 200,
                        'info_user'    => auth('account')->user(),
                        'history_bimbingan' => $bimbingan,
                        'mahasiswa_bimbingan' => $mahasiswa_bimbingan->count(),
                        'siap_sidang' => $mahasiswa_siap_sidang->whereHas('get_pembimbing', function($query) {
                            $query->where('id_account', auth('account')->user()->id_account);
                        })->count()
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
