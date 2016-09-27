<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class attr_troncos_ip extends Model
{
    
    protected $table = 'attr_troncos_ip';

    protected $fillable = [
                'id',
                'conta_registro',
                'senha_registro',
                'dominio' ,
                'host',
                'proxy',
                'protocolo',
                'reenc_chamadas',
                'qualify',
                'reinvite' ,
                'pro_band',
                'tipo',
                'nat',
                'dtmf_mode',
                'insecure',
                'contexto',
                'porta'
     ];

 }
