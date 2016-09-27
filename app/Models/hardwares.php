<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class hardwares extends Model
{
    
    protected $table = 'hardwares';

    protected $fillable = [
            'id',
            'serial',
            'tipo',
            'ip',
            'portas',
            'perfis',
            'board',
            'hardware',
            'version'
     ];

 }
