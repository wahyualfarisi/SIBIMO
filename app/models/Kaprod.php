<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kaprod extends Model
{
    protected $table = 'kaprodi';
    protected $primaryKey = 'id_kaprodi';
    protected $fillable = [
        'id_account',
        'id_jurusan'
    ];

    public function get_jurusan()
    {
        return $this->belongsTo('App\models\Jurusan','id_jurusan', 'id_jurusan');
    }


}
