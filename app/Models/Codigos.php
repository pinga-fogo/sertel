<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Codigos extends Model
{
    
    protected $table = 'cod_de_contas';

    protected $fillable = [
            'nome',
            'codigo',
            'senha',
            'bloqueios'         
     ];

 }
