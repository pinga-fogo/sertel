<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Destinos extends Model
{
    
    protected $table = 'destinos';

    protected $fillable = [
            'destino',
            'troncos'          
     ];

 }
