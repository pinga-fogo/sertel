<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Horarios extends Model
{
    
    protected $table = 'horarios';

    protected $fillable = [
            'id',
            'seg',
            'ter',
            'qua',
            'qui',
            'sex',
            'sab',
            'dom'          
     ];

 }
