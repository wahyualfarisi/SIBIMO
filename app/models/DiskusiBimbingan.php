<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DiskusiBimbingan extends Model
{
    protected $table = 'diskusi_bimbingan';
    protected $primaryKey = 'id_diskusi_bimbingan';
    protected $fillable = [
        'id_bimbingan',
        'id_pembimbing',
        'id_mahasiswa',
        'pesan'
    ];
}
