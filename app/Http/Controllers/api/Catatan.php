<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\models\CatatanBimbingan as CatatanModel;
use App\models\Bimbingan;

class Catatan extends Controller
{
    public function create(Request $request )
    {
        $validated = Validator::make($request->all(), [
            'id_bimbingan' => 'required',
            'catatan'      => 'required'
        ]);

        if($validated->fails())
        return response()->json([
            'status'   => false,
            'message'  => 'Fields Required',
            'errors'   => $validated->errors()
        ], 422);

        $bimbingan = Bimbingan::findOrFail($request->id_bimbingan);

        $filenametoStore = null;
        

        if( $request->file('file')){
            try{
                $file = $request->file('file');
    
                $name = $file->getClientOriginalName();
    
                $filename = pathinfo($name, PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
    
                $filenametoStore = $bimbingan->get_mahasiswa->nim.'_'.date('Y-m-d').'_'.time().'.'.$filename.'.'.$extension;
    
                $file->storeAs('public/file/'.$bimbingan->get_mahasiswa->nim.'/catatan/', $filenametoStore);
            
            }catch(\Exception $e){
                return response()->json([
                    'status'   => false,
                    'message'  => $e->getMessage()
                ], 500);
            }
        }

        try{
            $catatan = new CatatanModel;
            $catatan->id_bimbingan = $bimbingan->id_bimbingan;
            $catatan->file         = $filenametoStore;
            $catatan->catatan      = $request->catatan;

            $catatan->save();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ], 500);
        }


        return response()->json([
            'status'   => true,
            'message'  => 'Success',
            'results'  => $catatan
        ]);
        


    }
}
