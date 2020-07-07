<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = [
        'nim',
        'nama_lengkap',
        'password',
        'kode_jurusan',
        'no_telp',
        'email',
        'angkatan'
    ];
}
