<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Saudacoes extends Model
{
    
    protected $table = 'saudacoes';

    protected $fillable = [
                'audio',
                'nome',
    ];

 }
