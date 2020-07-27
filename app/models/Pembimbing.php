<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Pembimbing extends Model
{
    protected $table = 'pembimbing';
    protected $primaryKey = 'id_pembimbing';
    protected $fillable = [
        'id_dospem',
        'id_mahasiswa'
    ];

    public function get_account()
    {
        return $this->belongsTo('App\models\Account', 'id_account','id_account');
    }

    public function get_mahasiswa()
    {
        return $this->belongsTo('App\models\Mahasiswa', 'id_mahasiswa', 'id_mahasiswa');
    }

}
