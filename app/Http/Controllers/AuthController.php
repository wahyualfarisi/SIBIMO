<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Validator;
use Hash;

//models
use App\models\Account;
use App\models\Mahasiswa;


class AuthController extends Controller
{
   
    public function login(Request $request)
    {
        $level = $request->session()->get('level');
        $login = $request->session()->get('login');

        if($login){
            return redirect('/main');
        }

        return view('login');
    }

    public function authorizationProcess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'    => 'required',
            'password' => 'required'
        ]);
 
        if( $validator->fails() ) {
             return response()->json([
                 'status'   => false,
                 'message'  => 'Fields Required',
                 'errors'   => $validator->errors()
             ], 422);
        }

         //check the IDs'
         $decide;
            $from_account = Account::where([
                ['nip', '=', $request->id]
            ])->first();
    
            $from_mahasiswa = Mahasiswa::where([
                ['nim', '=', $request->id]
            ])->first();
    
            if($from_account){
                $decide  = strtoupper($from_account->level);
            }else if($from_mahasiswa){
                $decide = 'MAHASISWA';
                
            }else{
                $decide = null;
            }
         //--------------
 
        switch ($decide) {
            case 'DOSEN':
                 case 'TU':
                     case 'KAPRODI':
                         $user = Account::where([
                             ['nip', '=', $request->id],
                             ['level', '=', $from_account->level]
                         ])->first();
                         
 
                         //1. cek jika username ada
                         if(!$user) return response()->json(['status' => false, 'message' => 'Account not found'], 404);
 
                         //2. cek jika password benar
                         if(!Hash::check($request->password , $user->password) ) 
                         return response()->json([
                             'status'   => false,
                             'message'  => 'Password salah'                                
                         ], 400);
 
                         $credential = [
                             'nip' => $request->id,
                             'password' => $request->password
                         ];
 
                         
                         
                         if(!$token = auth('account')->attempt($credential) ){
                             return response()->json([
                                 'status'   => false,
                                 'message'  => 'Unauthorized'
                             ], 401);
                         }
 
                         $request->session()->put('credentials', $token);
                         $request->session()->put('level', strtolower($user->level));
                         $request->session()->put('users', $user);
                         $request->session()->put('login', true);
 
                         return response()->json([
                             'status'   => true,
                             'message'  => 'Success Login',
                             'level'    => $request->level,
                             'token'    => $token,
                             'results'  => auth('account')->user()
                         ]);
                break;
            
            case 'MAHASISWA':
                       $user = Mahasiswa::where([
                           ['nim', '=', $request->id],
                       ])->first();
 
                       //1. cek jika username ada
                       if(!$user) return response()->json(['status' => false, 'message' => 'Account not found'], 404);
 
                       //2. cek jika password benar
                       if(!Hash::check($request->password , $user->password) ) 
                       return response()->json([
                           'status'   => false,
                           'message'  => 'Password salah'                                
                       ], 400);
 
                       $credential = [
                           'nim' => $request->id,
                           'password' => $request->password 
                       ];
 
                       if(!$token = auth('mahasiswa')->attempt($credential) ){
                             return response()->json([
                                 'status'   => false,
                                 'message'  => 'Unauthorized'
                             ], 401);
                       }
 
                     $request->session()->put('credentials', $token);
                     $request->session()->put('level', 'mahasiswa');
                     $request->session()->put('users',  $user);
                     $request->session()->put('login', true);
 
                     return response()->json([
                         'status'   => true,
                         'message'  => 'Success Login',
                         'level'    => 'MAHASISWA',
                         'token'    => $token,
                         'results'  => auth('mahasiswa')->user()
                     ]);
                break;

                default:
                    return response()->json([
                        'status'   => false,
                        'message'  => 'Account not found'
                    ]);
                break;
        }

      
    }

    public function authorizationClear(Request $request)
    {
        
        $login = $request->session()->get('login');
        

        if($login){
            $request->session()->remove('login');
        }
        return redirect('/login');
        
    }

}
