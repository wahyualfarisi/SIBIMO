<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\models\Pembimbing as Pembimbing_Model;
use App\models\Account;

class Pembimbing extends Controller
{
    public function index(Request $request)
    {
        if(!in_array(auth('account')->user()->level, ['TU']))
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        $data = Pembimbing_Model::with(['get_account','get_mahasiswa'])->get();

        try{
            return response()->json([
                'status'   => true,
                'message'  => 'Fetch dosen pembimbing',
                'results'  => $data
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong'
            ], 500);
        }
    }

    public function update_pembimbing(Request $request, $id_pembimbing)
    {
        if(!in_array(auth('account')->user()->level, ['TU']))
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        $validated  = Validator::make($request->all(), [
            'id_account' => 'required' 
        ]);

        if( $validated->fails() )
        return response()->json([
            'status'   => false,
            'message'  => 'Fields Required',
            'error' => $validated->errors()  
        ], 422);

        $pembimbing = Pembimbing_Model::findOrFail($id_pembimbing);
        $account    = Account::findOrFail($request->id_account);

        if( $account->level == 'TU' ) {
            return response()->json([
                'status'   => false,
                'message'  => 'Tu tidak bisa jadi pembimbing'
            ], 400);
        }

        try{
            $pembimbing->id_account = $account->id_account;
            $pembimbing->update();
        }catch(\Exception $e){
            return response()->json([
                'status'    => false,
                'error'   => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status'   => true ,
            'message'  => 'Success update pembimbing',
            'results'  => $pembimbing
        ]);

    }
}
