<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class KartuBimbingan extends Model
{
    protected $table = 'kartu_bimbingan';
    protected $primaryKey = 'id_kartu_bimbingan';
    protected $fillable = [
        'diterima_tanggal',
        'diujikan',
        'status',
        'id_mahasiswa'
    ];
}
