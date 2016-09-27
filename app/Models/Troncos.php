<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Troncos extends Model
{
    
    protected $table = 'troncos';

    protected $fillable = [
            'parent_id',
            'nome',
            'tecnologia',
            'fabricante',
            //'tipo',
            'rota',
            'rota_dir',
            'juntor',
            'juntor_atend',
            'juntor_cod_acess',
            'prefx_saida',
            'prefx_entrada',
            'prefx_juntor',
            'fidelidade',
            'remover_prefixo',

     ];


 }

/*'conta_registro', //-----
            'senha_registro',
            'dominio',
            'host',
            'proxy',
            'protocolo',
            'reenc_chamada',
            'qualify',
            'reinvite',
            'pro_band',
            'type',
            'nat',
            'dtmf_mode',
            'insecure',
            'contexto',
            'porta'  */