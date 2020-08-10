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

    public function get_dospem()
    {
        return $this->hasOneThrough(
            'App\models\Account',
            'App\models\Pembimbing',
            'id_pembimbing',
            'id_account',
            'id_pembimbing',
            'id_account'
        );
    }

    public function get_mahasiswa()
    {
        return $this->belongsTo('App\models\Mahasiswa', 'id_mahasiswa', 'id_mahasiswa');
    }

}
