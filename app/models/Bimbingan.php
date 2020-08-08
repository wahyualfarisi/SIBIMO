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
        'bab',
        'file',
        'status',
        'tanggal_bimbingan',
        'id_pembimbing'
    ];

    public $incrementing = false;
    


}
