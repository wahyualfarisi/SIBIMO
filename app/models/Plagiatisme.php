<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Plagiatisme extends Model
{
    protected $table = 'nilai_plagiatisme';
    protected $primaryKey = 'id_plagiatisme';
    protected $fillable = [
        'id_mahasiswa',
        'bab',
        'nilai_plagiatisme',
        'foto'
    ];

    public $timestamps = false;
    
}
