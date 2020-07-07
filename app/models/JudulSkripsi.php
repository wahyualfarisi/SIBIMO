<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class JudulSkripsi extends Model
{
    protected $table = 'judul_skripsi';
    protected $primaryKey = 'id_judul_skripsi';
    protected $fillable = [
        'id_mahasiswa',
        'judul',
        'status',
        'deskripsi'
    ];
}
