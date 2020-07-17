<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Dospem extends Model
{
    protected $table = 'dospem';
    protected $primaryKey = 'id_dospem';
    protected $fillable = [
        'id_account',
        'pembimbing',
    ];

    public function getAccount()
    {
        return $this->belongsTo('App\models\Account','id_account','id_account');
    }

    public function getMahasiswaBimbingan()
    {
        return $this->hasMany('App\models\Pembimbing', 'id_dospem','id_dospem');
    }

}
