<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB; 
use App\Models\Uras;
use App\Models\Audios;
use App\Models\Horarios;
use App\Models\Saudacoes;



class uraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->entity = new Uras;
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('admin.ura.index');
    }

    public function store(Request $request)
    {

        $ativ_saudacoes = $request->ativ_saudacoes == 'on' ? 1 : 0;
        $ativ_fechado = $request->ativ_fechado == 'on' ? 1 : 0;
        
        $um =    $request->dig_1_tipo != 'no' &&  $request->dig_1_destino != 'no' ? $request->dig_1_tipo.';'.$request->dig_1_destino : null;
        $dois =  $request->dig_2_tipo != 'no' &&  $request->dig_2_destino != 'no' ? $request->dig_2_tipo.';'.$request->dig_2_destino : null;
        $tres =  $request->dig_3_tipo != 'no' &&  $request->dig_3_destino != 'no' ? $request->dig_3_tipo.';'.$request->dig_3_destino : null;
        $quatro =  $request->dig_4_tipo != 'no' &&  $request->dig_4_destino != 'no' ? $request->dig_4_tipo.';'.$request->dig_4_destino : null;
        $cinco =  $request->dig_5_tipo != 'no' &&  $request->dig_5_destino != 'no' ? $request->dig_5_tipo.';'.$request->dig_5_destino : null;
        $seis =  $request->dig_6_tipo != 'no' &&  $request->dig_6_destino != 'no' ? $request->dig_6_tipo.';'.$request->dig_6_destino : null;
        $sete =  $request->dig_7_tipo != 'no' &&  $request->dig_7_destino != 'no'? $request->dig_7_tipo.';'.$request->dig_7_destino : null;
        $oito =  $request->dig_8_tipo != 'no' &&  $request->dig_8_destino != 'no' ? $request->dig_8_tipo.';'.$request->dig_8_destino : null;
        $nove =  $request->dig_9_tipo != 'no' &&  $request->dig_9_destino != 'no' ? $request->dig_9_tipo.';'.$request->dig_9_destino : null;
        $zero =  $request->dig_0_tipo != 'no' &&  $request->dig_0_destino != 'no' ? $request->dig_0_tipo.';'.$request->dig_0_destino : null;
        $tralha = $request->dig_tralha_tipo != 'no' &&  $request->dig_tralha_destino != 'no' ? $request->dig_tralha_tipo.';'.$request->dig_tralha_destino : null;
        $asteristico = $request->dig_asteristico_tipo != 'no' &&  $request->dig_asteristico_destino != 'no' ? $request->dig_asteristico_tipo.';'.$request->dig_asteristico_destino : null;
        $invalido = $request->dig_invalido_tipo != 'no' &&  $request->dig_invalido_destino != 'no' ? $request->dig_invalido_tipo.';'.$request->dig_invalido_destino : null;
        $time_out = $request->dig_time_out_tipo != 'no' &&  $request->dig_time_out_destino != 'no' ? $request->dig_time_out_tipo.';'.$request->dig_time_out_destino : null;

        $nova_ura = $this->entity->create([
                'nome'=>       $request->nome,
                'background'=> $request->background, 
                'playback'=>   $request->playback,
                'dig_1'=>             $um,
                'dig_2'=>             $dois,
                'dig_3'=>             $tres,
                'dig_4'=>             $quatro,
                'dig_5'=>             $cinco,
                'dig_6'=>             $seis,
                'dig_7'=>             $sete,
                'dig_8'=>             $oito,
                'dig_9'=>             $nove,
                'dig_0'=>             $zero,
                'dig_tralha'=>        $tralha,
                'dig_asteristico'=>   $asteristico,
                'dig_invalido'=>      $invalido,
                'dig_time_out'=>      $time_out,
                'ativ_saudacoes'=>    $ativ_saudacoes,
                'ativ_fechado' =>     $ativ_fechado
            ]);

        $horarios = new Horarios;
        $novo_horario = $horarios->create([
            'id' =>$nova_ura->id,
            'seg'=>$request->hora_seg, 
            'ter'=>$request->hora_ter, 
            'qua'=>$request->hora_qua,
            'qui'=>$request->hora_qui,
            'sex'=>$request->hora_sex,
            'sab'=>$request->hora_sab,
            'dom'=>$request->hora_dom
        ]);
        
        $this->atualizaArquivo();
        return back();
    }


    public function update(Request $request, $id)
    {   
       
        $ura = $this->entity->find($id);

        $ativ_saudacoes = $request->ativ_saudacoes == 'on' ? 1 : 0;
        $ativ_fechado = $request->ativ_fechado == 'on' ? 1 : 0;

        $um =    $request->dig_1_tipo != 'no' &&  $request->dig_1_destino != 'no' ? $request->dig_1_tipo.';'.$request->dig_1_destino : null;
        $dois =  $request->dig_2_tipo != 'no' &&  $request->dig_2_destino != 'no' ? $request->dig_2_tipo.';'.$request->dig_2_destino : null;
        $tres =  $request->dig_3_tipo != 'no' &&  $request->dig_3_destino != 'no' ? $request->dig_3_tipo.';'.$request->dig_3_destino : null;
        $quatro =  $request->dig_4_tipo != 'no' &&  $request->dig_4_destino != 'no' ? $request->dig_4_tipo.';'.$request->dig_4_destino : null;
        $cinco =  $request->dig_5_tipo != 'no' &&  $request->dig_5_destino != 'no' ? $request->dig_5_tipo.';'.$request->dig_5_destino : null;
        $seis =  $request->dig_6_tipo != 'no' &&  $request->dig_6_destino != 'no' ? $request->dig_6_tipo.';'.$request->dig_6_destino : null;
        $sete =  $request->dig_7_tipo != 'no' &&  $request->dig_7_destino != 'no'? $request->dig_7_tipo.';'.$request->dig_7_destino : null;
        $oito =  $request->dig_8_tipo != 'no' &&  $request->dig_8_destino != 'no' ? $request->dig_8_tipo.';'.$request->dig_8_destino : null;
        $nove =  $request->dig_9_tipo != 'no' &&  $request->dig_9_destino != 'no' ? $request->dig_9_tipo.';'.$request->dig_9_destino : null;
        $zero =  $request->dig_0_tipo != 'no' &&  $request->dig_0_destino != 'no' ? $request->dig_0_tipo.';'.$request->dig_0_destino : null;
        $tralha = $request->dig_tralha_tipo != 'no' &&  $request->dig_tralha_destino != 'no' ? $request->dig_tralha_tipo.';'.$request->dig_tralha_destino : null;
        $asteristico = $request->dig_asteristico_tipo != 'no' &&  $request->dig_asteristico_destino != 'no' ? $request->dig_asteristico_tipo.';'.$request->dig_asteristico_destino : null;
        $invalido = $request->dig_invalido_tipo != 'no' &&  $request->dig_invalido_destino != 'no' ? $request->dig_invalido_tipo.';'.$request->dig_invalido_destino : null;
        $time_out = $request->dig_time_out_tipo != 'no' &&  $request->dig_time_out_destino != 'no' ? $request->dig_time_out_tipo.';'.$request->dig_time_out_destino : null;

       $ura->update([
                'nome'=>              $request->nome,
                'background'=>        $request->background, 
                'playback'=>          $request->playback,
                'dig_1'=>             $um,
                'dig_2'=>             $dois,
                'dig_3'=>             $tres,
                'dig_4'=>             $quatro,
                'dig_5'=>             $cinco,
                'dig_6'=>             $seis,
                'dig_7'=>             $sete,
                'dig_8'=>             $oito,
                'dig_9'=>             $nove,
                'dig_0'=>             $zero,
                'dig_tralha'=>        $tralha,
                'dig_asteristico'=>   $asteristico,
                'dig_invalido'=>      $invalido,
                'dig_time_out'=>      $time_out,            
                'ativ_saudacoes'=>    $ativ_saudacoes,
                'ativ_fechado' =>     $ativ_fechado
            ]);

        $horarios = new Horarios;
        $esse = $horarios->find($id);
        $esse->update([
            'seg'=>$request->hora_seg, 
            'ter'=>$request->hora_ter, 
            'qua'=>$request->hora_qua,
            'qui'=>$request->hora_qui,
            'sex'=>$request->hora_sex,
            'sab'=>$request->hora_sab,
            'dom'=>$request->hora_dom
        ]);

        $this->atualizaArquivo();
        return back();
    }

    public function destroy(){

        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();
        $this->atualizaArquivo();
        return response()->json(['status'=>$id]);
    }

    // public function getExten($prioridade, $opts){
    //     $pula = chr(13).chr(10);

    //     switch($opts[0]){
    //                       case 'ura': 
    //                             $string = "exten => $prioridade,1,Goto(URA-$opts[1],s,1) $pula";
    //                       break;

    //                       case 'ramal':
    //                             $string = "exten => $prioridade,1,AGI(Entrantes.php) $pula";                                
    //                       break;

    //                       case 'grupo':
    //                             $string = "exten => $prioridade,1,AGI(Entrantes.php) $pula";                                                                
    //                       break;

    //                       case 'audio':
    //                             $audio = new Audios;
    //                             $audio = $audio->find($opts[1]);

    //                             $string = "exten => $prioridade,1,Playback($audio->nome) $pula";                    
    //                       break;
    //     }

    //     return $string;


    // }

    

    

    public function geraHorarios($ura){

        $array_semana = [ 'sun'=>$ura->dom, 
                          'mon'=>$ura->seg,
                          'tue'=>$ura->ter,
                          'wed'=>$ura->qua,
                          'thu'=>$ura->qui,
                          'fri'=>$ura->sex,
                          'sat'=>$ura->sab,
                        ];

        // $array_separado = [];
        
        foreach($array_semana as $key=>$horario){
             
             if(!isset($array_separado[$horario])){
                  $array_separado[$horario] = [];
             }

             array_push($array_separado[$horario], $key);
             
        }
        
         $string_semana_fechado = chr(13).chr(10);

        //ver se está fechado
        // if(isset($array_separado['00:00-00:00'])){
        //          $dias_fechado = implode(',',$array_separado['00:00-00:00']);


        //          //foreach($array_separado['00:00-00:00'] as $dia){
        //          //      unset($array_semana[$dia]);
        //          //}
                 
        //          //$string_fechado_dia_todo = chr(13).chr(10).'exten => s,4,Gotoiftime(*|'.$dias_fechado.'|*|*? fechado,s,1)'.chr(13).chr(10);
        //          //unset($array_separado['00:00-00:00']);
                 
                
        // }

        $priority = 4;
        foreach($array_semana as $key=>$horario){

    
                $condicao = "saudacao,s,1";

                if($horario == '00:00-00:00'){
                    $condicao = "fechado,s,1";
                }

                $string_semana_fechado .= "exten => s,".$priority++.",Gotoiftime(".$horario."|".$key."|*|*?".$condicao.")".chr(13).chr(10);
        }
        
    return $string_semana_fechado;
    }

    public function pegaSaudacoes(){
        $pula = chr(13).chr(10);
         $saudacoes_class = new Saudacoes;
         $audio_class = new Audios;
         $saudacoes_bom_dia = $saudacoes_class->where('nome','=','bom dia')->first();
         $saudacoes_boa_tarde = $saudacoes_class->where('nome','=','boa tarde')->first();
         $saudacoes_boa_noite = $saudacoes_class->where('nome','=','boa noite')->first();
         $saudacoes_fechado = $saudacoes_class->where('nome','=','fechado')->first();

      
         if(count($saudacoes_bom_dia) == 1){
               $audio_bom_dia = $this->pegaAudioNome($saudacoes_bom_dia->audio);;
               $string_bom_dia =  "[BomDia]".$pula.
                                  //"exten => s,1,Answer()".$pula.
                                  "exten => s,1,Playback(".$audio_bom_dia.")".$pula.
                                  "exten => s,n,Goto(URA-\${Ura},s,Start)".$pula.$pula;
         }

         if(count($saudacoes_boa_tarde) == 1){
                $audio_boa_tarde = $this->pegaAudioNome($saudacoes_boa_tarde->audio);
                $string_boa_tarde = "[BoaTarde]".$pula.
                                   // "exten => s,1,Answer()".$pula.
                                    "exten => s,1,Playback(".$audio_boa_tarde.")".$pula.
                                    "exten => s,n,Goto(URA-\${Ura},s,Start)".$pula.$pula;
         }

         if(count($saudacoes_boa_noite) == 1){
                $audio_boa_noite =$this->pegaAudioNome($saudacoes_boa_noite->audio);
                $string_boa_noite = "[BoaNoite]".$pula.
                                    //"exten => s,1,Answer()".$pula.
                                    "exten => s,1,Playback(".$audio_boa_noite.")".$pula.
                                    "exten => s,n,Goto(URA-\${Ura},s,Start)".$pula.$pula;
         }
         

         if(count($saudacoes_boa_noite) == 1){
                //$audio_fechado = $audio_class->where('id', '=', $saudacoes_fechado->audio)->first();
                $audio_fechado = $this->pegaAudioNome($saudacoes_fechado->audio);
                $string_fechado = "[fechado]".$pula.
                                  //"exten => s,1,Answer()".$pula.
                                  "exten => s,1,Playback(".$audio_fechado.")".$pula.
                                  "exten => s,n,Hangup()".$pula.$pula;
         }

         $audio_boa_tarde = $audio_class->where('id', '=', $saudacoes_boa_tarde->audio);
         $audio_boa_noite = $audio_class->where('id', '=', $saudacoes_boa_noite->audio);

        

         $string = $string_bom_dia.$string_boa_tarde.$string_boa_noite.$string_fechado;

         return $string;               
    }

    public function pegaAudioNome($idAudio){
        $audio_class= new Audios;
        $audio = $audio_class->where('id', '=', $idAudio)->first();
        return $audio->nome;
    }

    public function getOpts($i, $opts, $priority = 1){
            $tipo = $opts[0];
            $id = $opts[1];
            $pula = chr(13).chr(10);
            $string = '';

            switch($tipo){
                          case 'ura': 
                                $ura = DB::table('uras')->where('id','=', $id)->first();
                                $string .= "exten => $i,1,Goto(URA-$ura->nome,s,1) $pula";
                          break;

                          case 'ramal':
                                $ramal = DB::table('ramais')->where('id', '=', $id)->first();
                                $string .= 'exten => '.$i.',1,Set(NUMERO_ENTRANTE='.$ramal->numero.')'.$pula; 
                                $string .= 'exten => '.$i.',n,AGI(Entre_ramais.php)'.$pula;                                
                          break;

                          case 'grupo':
                                $string .= $pula.'exten => '.$i.',1,Set(GO_GRUPO='.$id.') '.$pula;
                                $string .= 'exten => '.$i.',n,AGI(Entrantes.php)'.$pula;                                                                
                          break;

                          case 'audio':
                                $audio = new Audios;
                                $audio = $audio->find($opts[1]);

                                $string .= $pula.'exten => '.$i.',1,Playback('.$audio->nome.')'.$pula;                    
                          break;
        }
           

            return $string;
    }

    public function atualizaArquivo(){
        $arquivo = '/etc/asterisk/app_ura.conf';

        $pula = chr(13).chr(10);
        
        $array_final = [];

        $string_saudacoes = $this->pegaSaudacoes();

        $contextos =  "[saudacao]".$pula.
                          "exten => s,1,Gotoiftime(04:00-11:59 |*|*|*?BomDia,s,1)".$pula.
                          "exten => s,n,Gotoiftime(11:59-17:59 |*|*|*?BoaTarde,s,1)".$pula.
                          "exten => s,n,Gotoiftime(18:00-03:59 |*|*|*?BoaNoite,s,1)".$pula.$pula.
                          $string_saudacoes
                          ;

        $uras = DB::table('uras')->join('horarios', 'uras.id', '=', 'horarios.id')->get();

        $string_array = [];
        $array_digitos = [];        

        foreach ($uras as $ura){
                

                $horarios_fechado = '';

                $horarios_fechado = $this->geraHorarios($ura);
                
                $string_playback = '';
                $string_background = '';

                $playback = 0;

              if($ura->playback != '0' && $ura->playback != null && $ura->playback != ''){ 
                $playback = 1;
                $string_playback = 'exten => s,n(Start),Playback('.$this->pegaAudioNome($ura->playback).')'.$pula;
              }

              if($ura->background != '0' && $ura->background != null && $ura->background != ''){
                $priority_sufix = $playback == 0 ?'(Start)' : '';
                $string_background = 'exten => s,n'.$priority_sufix.',Background('.$this->pegaAudioNome($ura->background).')'.$pula;
              }

              $string = $pula.'[URA-'.$ura->nome.']'.$pula.
                                'exten => s,1,Wait(1.0)'.$pula.
                                'exten => s,2,Answer()'.$pula.
                                'exten => s,3,Set(_Ura='.$ura->nome.')'.$pula.
                                 $horarios_fechado.$pula.
                                 $string_playback.
                                 $string_background.
                                'exten => s,n,waitexten(5)'.$pula.$pula
                                ;


            for($i = 0; $i < 10; $i++){

                        if($ura->{'dig_'.$i} != null && $ura->{'dig_'.$i} != ''){
                            $opts = explode(';', $ura->{'dig_'.$i});                     
                            
                            $string .= $this->getOpts($i, $opts);

                            //$string .= $this->getExten($i, $opts);
                        }

            }  

            $string .= $pula;

            if($ura->dig_time_out != null && $ura->dig_time_out != ''){
                    $string .= $this->getOpts('t', $opts);
            }

            $string .= $pula;

            if($ura->dig_invalido != null && $ura->dig_invalido != ''){
                    //$string .= 'exten => i,11,Playback(invalid)'.$pula;
                    $string .= $this->getOpts('i', $opts);
            }

            $string .= $pula.'exten => h,1,Hangup()';
          
          array_push($array_final, $contextos.$string);

        }

        file_put_contents($arquivo, implode(chr(13).chr(10), $array_final));
        shell_exec('rasterisk -x "reload"');
    }
    
}
