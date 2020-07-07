<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';
    protected $primaryKey = 'id_account';
    protected $fiilable = [
        'nip',
        'nama_lengkap',
        'email',
        'password',
        'no_telp',
        'alamat',
        'foto',
        'level'
    ];

    public function get_dospem()
    {
        return $this->hasOne('App\Dospem', 'id_account','id_account');
    }

    public function get_kaprod()
    {
        return $this->hasOne('App\Kaprod','id_account','id_account');
    }

    

}
