<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ramal extends Model
{
    protected $table = 'ramais';

    protected $fillable = [
            'tipo',
            'nome',
            'tecnologia',
            'aplicacao',
            'ddr',
            'no_externo',
            'numero',
            'senha',
            'capturar',
            'estacionar_chamadas',
            'desvio_tipo',
            'desvio_para',
            'nao_perturbe',
            'conferencia',
            'codigo_conta',
            'centro_custo',
            'acesso_porteiro',
            'nat',
            'status',
            'profile_ramal_id',
            'porta',
            'central'
    ];
}