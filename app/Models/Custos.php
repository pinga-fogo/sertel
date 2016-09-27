<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Custos extends Model
{
    
    protected $table = 'custos';

    protected $fillable = [
                'nome',
                'credito_inicial',
                'credito_atual',
                'recarga_mensal'
     ];

 }
