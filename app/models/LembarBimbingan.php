<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class LembarBimbingan extends Model
{
    protected $table = 'lembar_bimbingan';
    protected $primaryKey = 'id_lembar_bimbingan';
    protected $fiilable = [
        'id_pembimbing',
        'id_bimbingan',
        'permasalahan',
        'revisi',
        'acc',
        'paraf'
    ];

    public function get_bimbingan()
    {
        return $this->hasOne('App\models\Bimbingan', 'id_bimbingan','id_bimbingan');
    }
}
