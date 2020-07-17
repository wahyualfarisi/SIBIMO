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

    public function get_dospem()
    {
        return $this->belongsTo('App\models\Dospem', 'id_dospem','id_dospem');
    }

}
