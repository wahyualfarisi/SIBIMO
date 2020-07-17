<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AddJurusan;

use App\models\Jurusan as JurusanModel;

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
}
