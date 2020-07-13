<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Hash;

//models
use App\models\Account;
use App\models\Mahasiswa;


class Auth extends Controller
{
    public function login(Request $request)
    {
       $validator = Validator::make($request->all(), [
           'level' => 'required|in:MAHASISWA,DOSEN,TU,KAPRODI',
           'nip'   => 'required_if:level,==,DOSEN,TU,KAPRODI',
           'nim'   => 'required_if:level,==,MAHASISWA',
           'password' => 'required'
       ]);

       if( $validator->fails() ) {
            return response()->json([
                'status'   => false,
                'message'  => 'Fields Required',
                'errors'   => $validator->errors()
            ], 422);
       }

       switch ($request->level) {
           case 'DOSEN':
                case 'TU':
                    case 'KAPRODI':
                        $user = Account::where([
                            ['nip', '=', $request->nip],
                            ['level', '=', $request->level]
                        ])->first();

                        //1. cek jika username ada
                        if(!$user) return response()->json(['status' => false, 'message' => 'Account not found'], 404);

                        //2. cek jika password benar
                        if(!Hash::check($request->password , $user->password) ) 
                        return response()->json([
                            'status'   => false,
                            'message'  => 'Password salah'                                
                        ], 400);

                        $credential = request(['nip','password']);
                        
                        if(!$token = auth('account')->attempt($credential) ){
                            return response()->json([
                                'status'   => false,
                                'message'  => 'Unauthorized'
                            ], 401);
                        }

                        return response()->json([
                            'status'   => true,
                            'message'  => 'Success Login',
                            'level'    => $request->level,
                            'token'    => $token,
                            'results'  => auth('account')->user()
                        ]);
               break;
           
           default:
                      $user = Mahasiswa::where([
                          ['nim', '=', $request->nim],
                      ])->first();

                      //1. cek jika username ada
                      if(!$user) return response()->json(['status' => false, 'message' => 'Account not found'], 404);

                      //2. cek jika password benar
                      if(!Hash::check($request->password , $user->password) ) 
                      return response()->json([
                          'status'   => false,
                          'message'  => 'Password salah'                                
                      ], 400);

                      $credential = request(['nim','password']);

                      if(!$token = auth('mahasiswa')->attempt($credential) ){
                            return response()->json([
                                'status'   => false,
                                'message'  => 'Unauthorized'
                            ], 401);
                      }

                    return response()->json([
                        'status'   => true,
                        'message'  => 'Success Login',
                        'level'    => 'MAHASISWA',
                        'token'    => $token,
                        'results'  => auth('mahasiswa')->user()
                    ]);
               break;
       }
    }

    public function verify(){
        if(auth('mahasiswa')->user() ){
            return response()->json([
                'message' => 'Token verified',
                'status'  => 200,
                'data'    => auth('mahasiswa')->user()
            ]);
        }else if(auth('account')->user() ){
            return response()->json([
                'message' => 'Token verified',
                'status'  => 200,
                'data'    => auth('account')->user()
            ]);
        }
    }

    public function logout() {
        return auth('mahasiswa')->user();
    }
}
