<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $primaryKey = 'id_fakultas';
    protected $fillable = [
        'kode_fakultas',
        'nama_fakultas'
    ];
}
