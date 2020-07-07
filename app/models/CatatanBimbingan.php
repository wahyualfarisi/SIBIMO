<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CatatanBimbingan extends Model
{
    protected $table = 'catatan_bimbingan';
    protected $primaryKey = 'id_catatan_bimbingan';
    protected $fillable = [
        'id_bimbingan',
        'catatan',
        'file'
    ];

    

}
