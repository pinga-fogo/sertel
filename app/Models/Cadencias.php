<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cadencias extends Model
{
    
    protected $table = 'cadencias';

    protected $fillable = [
            'parent_id',
            'nome',  
            'valor'              
     ];

 }
