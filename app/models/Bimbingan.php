<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Bimbingan extends Model
{
    protected $table = 'bimbingan';
    protected $primaryKey = 'id_bimbingan';
    protected $fillable = [
        'id_mahasiswa',
        'deskripsi_bimbingan',
        'id_kategori_bimbingan',
        'file',
        'status',
        'tanggal_bimbingan',
        'id_pembimbing'
    ];

    


}
