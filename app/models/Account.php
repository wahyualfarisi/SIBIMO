<?php

namespace App\models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\Model;

class Account extends Authenticatable implements JWTSubject
{
    
    protected $table = 'account';
    protected $primaryKey = 'id_account';
    protected $fiilable = [
        'nip',
        'nama_lengkap',
        'email',
        'password',
        'no_telp',
        'alamat',
        'foto',
        'level'
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
    

    public function get_kaprod()
    {
        return $this->hasOne('App\models\Kaprod','id_account','id_account');
    }

    

}
