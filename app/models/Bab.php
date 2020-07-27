<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Bab extends Model
{
    protected $table = 'bab';
    protected $primaryKey = 'id_bab';
    protected $fillable = [
        'id_mahasiswa',
        'nama_bab',
        'status'
    ];
}
