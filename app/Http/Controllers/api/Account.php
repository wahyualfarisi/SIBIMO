<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\models\Account as AccountModel;
use App\models\Kaprod;

class Account extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        if(!in_array(auth('account')->user()->level, ['TU']))
        return response()->json([
            'status'   => false,
            'message'  => 'Permission denied'
        ], 401);

        if($request->has('get_dosen')){
            $level = 'DOSEN';
        }else if($request->has('get_kaprodi')){
            $level = 'KAPRODI';
        }else if($request->has('get_tu') ) {
            $level = 'TU';
        }
        
        $data = AccountModel::where('level', '=', $level )->get();

        try{
            return response()->json([
                'status'   => true,
                'message'  => 'Fetch account',
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
            'level' => 'required|in:TU,KAPRODI,DOSEN'
        ]);

        if($validate->fails())
        return response()->json([
            'status'   => false,
            'message'  => 'Field required',
            'error'    => $validate->errors()
        ], 422);


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

    public function updateAvatar(Request $request)
    {
        $user = $request->user('account');

        $validate = Validator::make($request->all(), [
            'foto' => 'required'
        ]);

        if( $validate->fails() )
        return response()->json([
            'status'   => false,
            'message'  => 'Fields Required',
            'error' => $validate->errors()
        ], 422);


        if($user->foto){
            $image_path = public_path().'/storage/foto/account/'.$user->foto;
            unlink($image_path);
        }

        try{
            $image = $request->file('foto');
            $name            = $image->getClientOriginalName();

            $filename        = pathinfo($name, PATHINFO_FILENAME);

            $extension       = $image->getClientOriginalExtension();

            $filenametostore = $user->nip.'_'.time().'.'.$extension;

            $add             = $image->storeAs('public/foto/account/', $filenametostore);
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }

        try{
            $user->foto = $filenametostore;

            $user->update();
        }catch(\Exception $e){
            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ], 500);
        }
        
        return response()->json([
            'status'   => true,
            'message'  => 'Success update foto',
            'results'  => $user
        ]);
    }
}
