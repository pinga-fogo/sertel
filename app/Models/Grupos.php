<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grupos extends Model
{
    protected $table = 'grupos';
    
    protected $fillable = [
            'tipo',
            'ramais',
            'numero',
            'rota_dir',
            'correio_de_voz',
            'tempo_chamada',
            'email'
    ];

    
}
