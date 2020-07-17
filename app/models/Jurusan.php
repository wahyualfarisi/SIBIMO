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

    public function get_kaprodi()
    {
        return $this->hasOne('App\models\Kaprod', 'id_jurusan','id_jurusan');
    }


}
