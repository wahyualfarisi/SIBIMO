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

    public function logout(Request $request) {
        
    }
}
