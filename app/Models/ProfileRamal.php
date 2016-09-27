<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileRamal extends Model
{
    protected $table = 'profiles_ramais';

    public function ramal(){
        return $this->belongsTo('App\Models\Ramal');
    }

    public function to_form_select($key=null){
        $res = $this->where('status','!=','0')->get();
        $arr = array();
        foreach ($res as $key => $value) {
            $arr[$value->id] = $value->name;
        }
        return $arr;
    }

    protected $fillable = [
        'nome',
        'envia_mcdu',
        'aceita_a_cobrar',
        'grupo_captura',
        'captura_grupos',
        'acesso_interno',
        'acesso_local',
        'acesso_fixo_ddd',
        'acesso_movel_local',
        'acesso_movel_ddd',
        'acesso_especial',
        'numeros_servico',
        'rota_especial',
        'agenda',
        'cadeado',
        'conferencia',
        'consulta_saldo',
        'siga_me',
        'ultimo_no_externo_recebido',
        'ultimo_no_interno_recebido',
        'voice_mail',
        'fala_ramal',
        'informacoes_servidor',
        'acesso_fila',
    ];
}
