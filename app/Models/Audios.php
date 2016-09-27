<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Audios extends Model
{
    
    protected $table = 'audios';

    protected $fillable = [
                'nome',
                'caminho',
     ];

 }
