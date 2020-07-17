<?php

namespace App\models;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Authenticatable implements JWTSubject
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $fillable = [
        'nim',
        'nama_lengkap',
        'password',
        'id_jurusan',
        'no_telp',
        'email',
        'alamat',
        'foto',
        'angkatan'
    ];

    protected $hidden = [
        'password'
    ];

     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    //jurusan
    public function get_jurusan()
    {
        return $this->belongsTo('App\models\Jurusan', 'id_jurusan','id_jurusan');
    }

    public function get_judul_skripsi()
    {
        return $this->hasOne('App\models\JudulSkripsi', 'id_mahasiswa', 'id_mahasiswa');
    }
    
}
