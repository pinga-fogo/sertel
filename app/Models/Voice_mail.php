<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Voice_mail extends Model
{
    
    protected $table = 'voice_mail';

    protected $fillable = [
            'nome'      , 
            'remetente' , 
            'destino'   , 
            'ramal'     , 
            'habilitado', 
            'mensagem'  ,
            'senha' 
     ];

 }
