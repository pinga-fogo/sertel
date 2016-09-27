<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Juntor extends Model
{
    
    protected $table = 'juntores';

    protected $fillable = [
            'nome',
            'juntor',  
            'fabricante',
            'board_serial'
     ];

 }
