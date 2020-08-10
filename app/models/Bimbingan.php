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
    

    public function get_diskusi()
    {
        return $this->hasMany('App\models\DiskusiBimbingan', 'id_bimbingan', 'id_bimbingan');
    }

    public function get_catatan()
    {
        return $this->hasMany('App\models\CatatanBimbingan', 'id_bimbingan', 'id_bimbingan');
    }

    public function get_lembar_bimbingan()
    {
        return $this->hasOne('App\models\LembarBimbingan', 'id_bimbingan', 'id_bimbingan');
    }

    public function get_account()
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

    public function get_pembimbing()
    {
        return $this->belongsTo('App\models\Pembimbing', 'id_pembimbing','id_pembimbing');
    }

    public function get_mahasiswa()
    {
        return $this->belongsTo('App\models\Mahasiswa','id_mahasiswa', 'id_mahasiswa');
    }
    

}
