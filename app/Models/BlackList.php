<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class BlackList extends Model
{
    
    protected $table = 'black_list';

    protected $fillable = [
                'numero',
                'tronco',
                'tipo_bloqueio',
     ];

 }
