<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Saudacoes;


class saudacoesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->entity = new Saudacoes;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $bom_dia = $this->entity->where('nome','=','bom dia');
        $boa_tarde = $this->entity->where('nome','=','boa tarde');
        $boa_noite = $this->entity->where('nome','=','boa noite');
        $fechado = $this->entity->where('nome','=','fechado');


        if(count($bom_dia->get()) < 1){
            $this->entity->create([
                    'nome'=>'bom dia',
                    'audio'=>''
            ]);
        }
        
        if(count($boa_tarde->get()) < 1){
            $this->entity->create([
                    'nome'=>'boa tarde',
                    'audio'=>''
            ]);
        }

        if(count($boa_noite->get()) < 1){
            $this->entity->create([
                    'nome'=>'boa noite',
                    'audio'=>''
            ]);
        }
        
        if(count($fechado->get()) < 1){
            $this->entity->create([
                    'nome'=>'fechado',
                    'audio'=>''
            ]);
        }


        $bom_dia->update([
                //'nome' => $request->bom_dia_nome,
                'audio' => $request->bom_dia_audio
            ]);

        $boa_tarde->update([
                //'nome' => $request->boa_tarde_nome,
                'audio' => $request->boa_tarde_audio
            ]);

        $boa_noite->update([
                //'nome' => $request->boa_noite_nome,
                'audio' => $request->boa_noite_audio
            ]);

        $fechado->update([
                //'nome' => $request->boa_noite_nome,
                'audio' => $request->fechado_audio
            ]);

        $audio_controller = new UraController();
        $audio_controller->atualizaArquivo();
        return back();
    }
    
}
