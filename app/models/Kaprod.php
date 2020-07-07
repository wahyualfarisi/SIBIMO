<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kaprod extends Model
{
    protected $table = 'kaprod';
    protected $primaryKey = 'id_kaprod';
    protected $fillable = [
        'id_account',
        'id_jurusan'
    ];
}
