<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Centrais extends Model
{
    
    protected $table = 'centrais';

    protected $fillable = [
                'nome',
                'tipo',
                'tronco',
                'codigo'
    ];

 }
