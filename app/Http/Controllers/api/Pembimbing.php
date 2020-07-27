<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\models\Pembimbing as Pembimbing_Model;

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
}
