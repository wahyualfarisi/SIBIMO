<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class HasilBimbingan extends Model
{
    protected $table = 'hasil_bimbingan';
    protected $primaryKey = 'id_hasil_bimbingan';
    protected $fiilable = [
        'id_kartu_bimbingan',
        'id_pembimbing',
        'id_bimbingan',
        'revisi',
        'acc'
    ];
}
