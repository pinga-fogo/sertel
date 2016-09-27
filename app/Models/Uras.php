<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Uras extends Model
{
    
    protected $table = 'uras';

    protected $fillable = [
                'id',
                'nome',
                'background',
                'playback',
                'dig_1',
                'dig_2',
                'dig_3',
                'dig_4',
                'dig_5',
                'dig_6',
                'dig_7',
                'dig_8',
                'dig_9',
                'dig_0',
                'dig_tralha',
                'dig_asteristico',
                'dig_invalido',
                'dig_time_out',
                'ativ_saudacoes',
                'ativ_fechado' 
    ];

 }
