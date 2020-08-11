<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\models\Plagiatisme as PlagiatismeModel;
use App\models\Mahasiswa;

class Plagiatisme extends Controller
{
    public function index(Request $request, $id_mahasiswa)
    {
        $plagiatisme = PlagiatismeModel::where('id_mahasiswa', $id_mahasiswa)->get();

        try{
            return response()->json([
                'status'   => true,
                'message'  => 'Fetch Plagiatisme',
                'results'  => $plagiatisme
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        if(auth('account')->user()){
            return response()->json([
                'status'   => false,
                'message'  => 'Permission denied'
            ], 401);
        }

        if(!auth('mahasiswa')->user())
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        $validated = Validator::make($request->all(), [
            'bab'          => 'required|in:BAB 1,BAB 2,BAB 3,BAB 4,BAB 5,ALL BAB',
            'nilai_plagiatisme' => 'required',
            'foto' => 'required'
        ]);

        if( $validated->fails() )
        return response()->json([
            'status'   => false,
            'message'  => 'Fields Required',
            'errors'   => $validated->errors()
        ], 422);

        $mahasiswa = Mahasiswa::findOrFail( auth('mahasiswa')->user()->id_mahasiswa );


        try{
            $file = $request->file('foto');

            $name = $file->getClientOriginalName();

            $filename = pathinfo($name, PATHINFO_FILENAME);

            $extension = $file->getClientOriginalExtension();

            $filenametoStore = time().'.'.$extension;

            $file->storeAs('public/file/plagiatisme/', $filenametoStore);

        }catch(\Exception $e){
            return  response()->json([
                'status'   => false,
                'message'  => $e->getMessage()
            ], 500);
        }

        try{
            $plagiatisme = new PlagiatismeModel;

            $plagiatisme->id_mahasiswa = auth('mahasiswa')->user()->id_mahasiswa;
            $plagiatisme->bab          = $request->bab;
            $plagiatisme->nilai_plagiatisme = $request->nilai_plagiatisme;
            $plagiatisme->foto = $filenametoStore;
            $plagiatisme->save();
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'errors' => $e->getMessage()
            ], 500);
        }

        return response()->json([
            'status'   => true,
            'message'  => 'Success',
            'results'  => $plagiatisme
        ]);

    }

    public function update(Request $request, $id_plagiatisme)
    {

    }

    public function delete(Request $request)
    {

    }
}
