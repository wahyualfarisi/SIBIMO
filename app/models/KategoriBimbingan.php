<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class KategoriBimbingan extends Model
{
    protected $table = 'kategori_bimbingan';
    protected $primaryKey = 'id_kategori_bimbingan';
    protected $fillable = [
        'kategori'
    ];
}
