<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\models\Account as AccountModel;
use App\models\Dospem;
use App\models\Kaprod;

class Account extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!in_array(auth('account')->user()->level, ['TU']))
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        $data = AccountModel::with([
            'get_dospem'
        ])
        ->where('level', '!=', 'TU')
        ->get();

        try{
            return response()->json([
                'status'   => false,
                'message'  => 'Fetch all account',
                'results'  => $data
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
    public function store(Request $request)
    {
        if(!in_array(auth('account')->user()->level, ['TU'] ))
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        $validate = Validator::make($request->all(), [
            'nip' => 'required',
            'email' => 'required',
            'nama_lengkap' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'level' => 'required|in:TU,KAPRODI,DOSEN',
            'to_be_pembimbing' => 'required|in:1,2'
        ]);

        if($validate->fails())
        return response()->json([
            'status'   => false,
            'message'  => 'Field required',
            'error'    => $validate->errors()
        ], 422);

    
        if( $request->level == 'KAPRODI' ){
            $validate = Validator::make($request->all(), [
                'id_jurusan' => 'required'
            ]);

            if($validate->fails()){
                return response()->json([
                    'status'   => false,
                    'message'  => 'Your selected level with value KAPRODI',
                    'errors'   => $validate->errors()
                ]);
            }
        }


        //check apakah nip dan email sudah di gunakan
        $check = AccountModel::where('email', $request->email)
                ->orWhere('nip', $request->nip)
                ->first();
        if($check)
        return response()->json([
            'status'   => false,
            'message'  => 'Nip / email sudah ada'
        ]);
        //--------------------------------------------

        DB::beginTransaction();

        try{
            $new_account = new AccountModel;
            $new_account->nip = $request->nip;
            $new_account->password = bcrypt($request->nip);
            $new_account->email = $request->email;
            $new_account->nama_lengkap = $request->nama_lengkap;
            $new_account->no_telp = $request->no_telp;
            $new_account->alamat = $request->alamat;
            $new_account->level = $request->level;
            $new_account->save();

        }catch(\Exception $e){
            DB::rollback();
            return response()->json([
                'status'   => false,
                'message'  => 'Failed to add account'
            ], 500);
        }

        switch($request->level)
        {
            case 'DOSEN':
                try{
                    $pembimbing = new Dospem;
                    $pembimbing->id_account = $new_account->id_account;
                    $pembimbing->pembimbing = $request->to_be_pembimbing;
                    $pembimbing->save();
                }catch(\Exception $e){
                    DB::rollback();
                    return response()->json([
                        'status'  => false,
                        'message' => 'Failed to add dospem'
                    ], 500);
                }
            break;


            case 'KAPRODI':
                try{
                    $pembimbing = new Dospem;
                    $pembimbing->id_account = $new_account->id_account;
                    $pembimbing->pembimbing = $request->to_be_pembimbing;

                    $pembimbing->save();
                }catch(\Exception $e){
                    DB::rollback();
                    return response()->json([
                        'status'  => false,
                        'message' => 'Failed to add dospem'
                    ], 500);
                }

                try{
                    $kaprodi   = new Kaprod;
                    $kaprodi->id_account = $new_account->id_account;
                    $kaprodi->id_jurusan = $request->id_jurusan;
                    $kaprodi->save();
                }catch(\Exception $e){
                    return  response()->json([
                        'status'   => false,
                        'message'  => 'Failed to add kaprodi'
                    ]);
                }
            break;
        }
        
        DB::commit();
        return response()->json([
            'status'   => true,
            'message'  => 'Berhasil menambahkan '.$request->level,
            'results'  => $new_account
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
        if(!in_array(auth('account')->user()->level, ['TU'] ))
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!in_array(auth('account')->user()->level, ['TU'] ))
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!in_array(auth('account')->user()->level, ['TU'] ))
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);
    }
}
