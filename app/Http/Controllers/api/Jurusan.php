<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddJurusan;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\models\Jurusan as JurusanModel;
use App\models\Account;
use App\models\Kaprod;


class Jurusan extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return response()->json([
                'status'   => true,
                'message'  => 'Fetch jurusan',
                'results'  => JurusanModel::with('get_kaprodi.get_account')->get()
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong'
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddJurusan $request)
    {
        try{
            $jurusan = new JurusanModel;

            $jurusan->nama_jurusan = $request->nama_jurusan;

            $jurusan->save();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong'
            ], 500);
        }

        //response success
        return response()->json([
            'status'   => true,
            'message'  => 'Success add jurusan',
            'results'  => $jurusan
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jurusan = JurusanModel::with([
            'get_kaprodi.get_account',
            'get_mahasiswa.get_judul_skripsi'
        ])->findOrFail($id);
        try{
            return response()->json([
                'status'   => true,
                'message'  => 'Detail Jurusan',
                'results'  => $jurusan
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'error'  => $e->getMessage()
            ], 500);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddJurusan $request, $id)
    {
        
        try{
            $findJurusan = JurusanModel::find($id);

            $findJurusan->nama_jurusan = $request->nama_jurusan;
            
            $findJurusan->update();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong'
            ], 500);
        }

        //response success
        return response()->json([
            'status'   => true,
            'message'  => 'Success add jurusan',
            'results'  => $findJurusan
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{    
            $findJurusan = JurusanModel::find($id);

            $findJurusan->delete();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something wrong'
            ], 500);
        }

        //response success
        return response()->json([
            'status'   => true,
            'message'  => 'Success delete jurusan',
            'results'  => $findJurusan
        ]);
    }

    public function updateKaprodi(Request $request, $id_jurusan)
    {
        $validator = Validator::make($request->all(), [
            'id_account' => 'required',
            'id_kaprodi' => 'required'
        ]);

        if($validator->fails())
            return response()->json([
                'status'   => false,
                'message'  => 'Fields Required',
                'error' => $validator->errors()
            ], 422);


        $kaprodi = Kaprod::findOrFail($request->id_kaprodi);
        
        //old kaprodi
        $kaprodi_account = Account::findOrfail($kaprodi->id_account);

        DB::beginTransaction();

        //update old kaprodi to LEVEL dosen
        try{
            $kaprodi_account->level = 'DOSEN';
            $kaprodi_account->save();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
        
        //update new account to kaprodi
        $account = Account::findOrFail($request->id_account);

        if($account->level == 'TU')
        return response()->json([
            'status' => false,
            'messae' => 'TU cannot to be Kaprodi'
        ]);

        if($account->level == 'KAPRODI')
        return response()->json([
            'status'  => false,
            'message' => 'Akun sudah menjadi kaprodi'
        ]);

        try{
            $account->level = 'KAPRODI';
            $account->save();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'message'  => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }

        //update kaprodi
        try{
            $kaprodi->id_account = $account->id_account;
            $kaprodi->update();
        }catch(\Exception $e){
            return response()->json([
                'status'   => false,
                'error'  => $e->getMessage()
            ], 500);
        }

        DB::commit();
        return response()->json([
            'status'   => true,
            'message'  => 'Success update kaprodi',
            'results'  => $kaprodi->get_account
        ]);
        
    }
}
