<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Tarifas extends Model
{
    
    protected $table = 'tarifas';

    protected $fillable = [
            'operadora',
            'numero_operadora',
            'tarifa_fixo',
            'tarifa_movel'
     ];

 }
