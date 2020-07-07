<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $table = 'jurusan';
    protected $primaryKey = 'id_jurusan';
    protected $fillable = [
        'id_jurusan',
        'kode_jurusan',
        'nama_jurusan'
    ];
}
