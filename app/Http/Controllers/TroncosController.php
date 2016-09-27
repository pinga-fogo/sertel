<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Troncos;
use App\Models\attr_avanc_khomp;
use App\Models\attr_troncos_ip;
use App\Models\Cadencias;
use App\Models\WhiteList;
use App\Models\BlackList;
use App\Models\Destinos;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\PrefixosController;

class TroncosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*  public function index()
    {0
        return view('tronco.index', ['troncos' => $troncos]);
    } */
    public function __construct(Troncos $entity){
       
        $this->entity = new $entity; 
        $this->entity2 = new attr_avanc_khomp; 
        $this->entity3 = new attr_troncos_ip;
        $this->middleware('auth');
    
    }

    public function create(){
         return view('admin.troncos.create');
    }
   
    public function index(){
    //$resul = DB::table('troncos')->get();
    return view('admin.troncos.index', compact('troncos'));
   }
   
   
   /*public function join(){
   $troncosr = new Troncos;
   $attr_avanc_khomp = new attr_avanc_khomp;
   $attr_troncos_ip = new attr_troncos_ip;
   $attrarr = array();

   $resul = $troncosr::all();
   $attrs = $attr_avanc_khomp::all();
   $ip = $attr_troncos_ip::all();

   $attarray = $attrs->toArray();
   $troncosarray = $resul->toArray();
   $iparray = $ip->toArray();
   
   foreach($troncosarray as &$tronco){
         foreach ($attarray as $attkhomp){
            if($tronco['id'] == $attkhomp['id']){
              foreach($attkhomp as $key=>$a){
                 $tronco[(String)$key]= $a;
              }
            }
        }
   }
   }
  */
 /*
    public function edit($id){
        $resul =  DB::table('troncos')->join('attr_avanc_khomp', 'troncos.id', '=', 'attr_avanc_khomp.id')->first();
        
        if($resul->tecnologia == 11){
            $attrs =  DB::table('attr_troncos_ip')->where('id',$id)->first(); 
        }
               
        if($resul->tecnologia == 12 || $resul->tecnologia == 13 || $resul->tecnologia ==14 || $resul->tecnologia == 15){
            $attrs =  DB::table('attr_avanc_khomp')->where('id',$id)->first();    
            $juntorAtual = DB::table('juntores')->where('id',$resul->juntor)->first(); //Se não for IP pega o juntor atual
            $juntorAtual = $juntorAtual->id;
        }
        return view('admin.troncos.edit', compact('resul', 'attrs', 'juntorAtual'));
       
    }*/

    public function update($id){
            $entity = $this->entity->find($id);
            $entity2 = $this->entity->find($id);
            

            if(  isset($_GET['juntor']) && strpos($this->after('-',$_GET['juntor']) , 'Digivoice' ) !== false  || $_GET['tecnologia']==15){

                   $troncosr = $entity->update([
                            'fabricante' => isset($_GET['juntor']) ? $this->after('-',$_GET['juntor']) : null,
                            'nome' =>  isset($_GET['nome']) ? $_GET['nome'] : null,
                            'tecnologia' =>  isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                            //'tipo' =>  isset($_GET['tipo']) ? $_GET['tipo'] : null,
                            'juntor' =>  isset($_GET['juntor']) ? $_GET['juntor'] : null,
                            'rota' =>  isset($_GET['rota']) ? $_GET['rota'] : null,
                            'rota_dir' =>  isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                            'prefx_entrada' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                            'prefx_saida' => isset($_GET['prefx_saida']) ? $_GET['prefx_saida'] : null,
                            'juntor_cod_acess' =>  isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess'] : null,
                            'juntor_atend' =>  isset($_GET['juntor_atend'] ) ? $_GET['juntor_atend'] : null,
                            'prefx_juntor' => isset ($_GET['prefx_juntor'] ) ? $_GET['prefx_juntor'] :null,
                            'prefx_juntor' => isset ($_GET['prefx_juntor'] ) ? $_GET['prefx_juntor'] :null,         
                            'fidelidade' =>  isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null 
                     ]);
                         
            } 
            else if(  isset($_GET['juntor']) && ($_GET['tecnologia'] == 12) && ( strpos( $this->after('-',$_GET['juntor']) , 'KHOMP') !== false ) ){ // GSM-KHOMP                 
                     $entity = $this->entity->find($id);
                     $entity2 = $this->entity2->find($id);
                       
                        $entity->update([
                            'fabricante' => isset($_GET['juntor']) ? $this->after('-',$_GET['juntor']) : null,
                            'nome' =>  isset($_GET['nome']) ? $_GET['nome'] : null,
                            'tecnologia' =>  isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                            //'tipo' =>  isset($_GET['tipo']) ? $_GET['tipo'] : null,
                            'juntor' =>  isset($_GET['juntor']) ? $_GET['juntor'] : null,
                            'rota' =>  isset($_GET['rota']) ? $_GET['rota'] : null,
                            'rota_dir' =>  isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                            'prefx_entrada' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                            'prefx_saida' => isset($_GET['prefx_saida']) ? $_GET['prefx_saida'] : null,
                            'juntor_cod_acess' =>  isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess'] : null,
                            'juntor_atend' =>  isset($_GET['juntor_atend'] ) ? $_GET['juntor_atend'] : null ,
                            'fidelidade' =>  isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null,
                         ]);

                        $entity2->update ([
                            'ccss_enable'=> isset($_GET['ccss_enable'] ) ? $_GET['ccss_enable'] : null ,
                            'audio_rx_sync'=> isset($_GET['audio_rx_sync'] ) ? $_GET['audio_rx_sync'] : null ,
                            'context_gsm_call'=> isset($_GET['context_gsm_call'] ) ?$_GET['context_gsm_call'] : null ,
                            'context_gsm_sms'=> isset($_GET['context_gsm_sms'] ) ? $_GET['context_gsm_sms'] : null ,
                            'volume_tx'=> isset($_GET['volume_tx'] ) ? $_GET['volume_tx'] : null ,
                            'volume_rx'=> isset($_GET['volume_rx'] ) ? $_GET['volume_rx'] : null ,
                            'suprimir_id'=> isset($_GET['suprimir_id'] ) ? $_GET['suprimir_id'] : null ,
                            'block_call'=> isset($_GET['block_call'] ) ? $_GET['block_call'] : null ,
                            'disconnect_call'=> isset($_GET['disconnect_call'] ) ? $_GET['disconnect_call'] : null ,
                            'co_dialtone'=> isset($_GET['co_dialtone'] ) ? $_GET['co_dialtone'] : null ,
                            'vm_dialtone'=> isset($_GET['vm_dialtone'] ) ? $_GET['vm_dialtone'] : null ,
                            'pbx_dialtone'=> isset($_GET['pbx_dialtone'] ) ? $_GET['pbx_dialtone'] : null ,
                            'fast_busy'=> isset($_GET['fast_busy'] ) ? $_GET['fast_busy'] : null ,
                            'ring_back'=> isset($_GET['ring_back'] ) ? $_GET['ring_back'] : null ,
                            'waiting_call'=> isset($_GET['waiting_call'] ) ? $_GET['waiting_call'] : null ,
                            'ring'=> isset($_GET['ring'] ) ? $_GET['ring'] : null ,
                            'context_digital'=> isset($_GET['context_digital'] ) ? $_GET['context_digital'] : null ,
                            'language'=> isset($_GET['language'] ) ? $_GET['language'] : null ,
                            'mohclass'=> isset($_GET['mohclass'] ) ? $_GET['mohclass'] : null ,
                            'flash_behaviour'=> isset($_GET['flash_behaviour'] ) ? $_GET['flash_behaviour']: null ,
                            'pendulum_digits'=> isset($_GET['pendulum_digits'] ) ? $_GET['pendulum_digits'] : null ,
                            'pendulum_hu_digits'=> isset($_GET['pendulum_hu_digits'] ) ? $_GET['pendulum_hu_digits'] : null 
                         ]);
                                     
                        if(isset($_GET['cadencias'])){
                          $cadencias_vetor = $_GET['cadencias'];
                          $cadenciaClass = new Cadencias;

                          foreach($cadencias_vetor as &$cadencia){
                                //o nome da cadencia e o valor vêm separados por "&"
                                $new_cadencia = explode('&', $cadencia);
                                 $cadenciaClass->create([
                                 'nome' => $new_cadencia[0],
                                 'valor' => $new_cadencia[1],
                                 'parent_id' => $id
                                 ]);
                          }
                         }

                            /*if( isset($troncosr) && $request->cad_stringbuffer){
                            $this->setCadencias($request->cad_stringbuffer, $troncosr);
                            } */

            
            } else if(  isset($_GET['juntor']) && $_GET['tecnologia'] == 13 && ( strpos( $this->after('-',$_GET['juntor']) , 'KHOMP') !== false )){ //DIGITAL KHOMP
                     $entity = $this->entity->find($id);
                     $entity2 = $this->entity2->find($id);
                      
                        $entity->update([
                      'fabricante' => isset($_GET['juntor']) ? $this->after('-',$_GET['juntor']) : null,
                      'nome' =>  isset($_GET['nome']) ? $_GET['nome'] : null,
                      'tecnologia' =>  isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                      //'tipo' =>  isset($_GET['tipo']) ? $_GET['tipo'] : null,
                      'juntor' =>  isset($_GET['juntor']) ? $_GET['juntor'] : null,
                      'rota' =>  isset($_GET['rota']) ? $_GET['rota'] : null,
                      'rota_dir' =>  isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                      'prefx_entrada' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                      'prefx_saida' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                      'juntor_cod_acess' =>  isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess']: null,
                      'juntor_atend' =>  isset($_GET['juntor_atend'] ) ? $_GET['juntor_atend'] : null, 
                      'fidelidade' =>  isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null 
           
                     ]);
                      
                     $entity2->update ([
                        'ccss_enable'=> isset($_GET['ccss_enable'] ) ? $_GET['ccss_enable'] : null ,
                        'audio_rx_sync'=> isset($_GET['audio_rx_sync'] ) ? $_GET['audio_rx_sync'] : null ,
                        //'context_gsm_call'=> isset($_GET['context_gsm_call'] ) ?$_GET['context_gsm_call']) : null ,
                        //'context_gsm_sms'=> isset($_GET['context_gsm_sms'] ) ? $_GET['context_gsm_sms']) : null ,
                        'volume_tx'=> isset($_GET['volume_tx'] ) ? $_GET['volume_tx'] : null ,
                        'volume_rx'=> isset($_GET['volume_rx'] ) ? $_GET['volume_rx'] : null ,
                        'suprimir_id'=> isset($_GET['suprimir_id'] ) ? $_GET['suprimir_id'] : null ,
                        'block_call'=> isset($_GET['block_call'] ) ? $_GET['block_call'] : null ,
                        'disconnect_call'=> isset($_GET['disconnect_call'] ) ? $_GET['disconnect_call'] : null ,
                        'co_dialtone'=> isset($_GET['co_dialtone'] ) ? $_GET['co_dialtone'] : null ,
                        'vm_dialtone'=> isset($_GET['vm_dialtone'] ) ? $_GET['vm_dialtone'] : null ,
                        'pbx_dialtone'=> isset($_GET['pbx_dialtone'] ) ? $_GET['pbx_dialtone'] : null ,
                        'fast_busy'=> isset($_GET['fast_busy'] ) ? $_GET['fast_busy'] : null ,
                        'ring_back'=> isset($_GET['ring_back'] ) ? $_GET['ring_back'] : null ,
                        'waiting_call'=> isset($_GET['waiting_call'] ) ? $_GET['waiting_call'] : null ,
                        'ring'=> isset($_GET['ring'] ) ? $_GET['ring'] : null ,
                        'context_digital'=> isset($_GET['context_digital'] ) ? $_GET['context_digital'] : null ,
                        'language'=> isset($_GET['language'] ) ? $_GET['language'] : null ,
                        'mohclass'=> isset($_GET['mohclass'] ) ? $_GET['mohclass'] : null ,
                        'flash_behaviour'=> isset($_GET['flash_behaviour'] ) ? $_GET['flash_behaviour'] : null ,
                        'pendulum_digits'=> isset($_GET['pendulum_digits'] ) ? $_GET['pendulum_digits'] : null ,
                        'pendulum_hu_digits'=> isset($_GET['pendulum_hu_digits'] ) ? $_GET['pendulum_hu_digits'] : null 
                     ]);
                
  
                         if(isset($_GET['cadencias'])){
                          $cadencias_vetor = $_GET['cadencias'];
                          $cadenciaClass = new Cadencias;

                          foreach($cadencias_vetor as &$cadencia){
                                //o nome da cadencia e o valor vêm separados por "&"
                                $new_cadencia = explode('&', $cadencia);
                                 $cadenciaClass->create([
                                 'nome' => $new_cadencia[0],
                                 'valor' => $new_cadencia[1],
                                 'parent_id' => $id
                                 ]);
                          }
                         }
                     
                
            } else if(  isset($_GET['juntor']) && $_GET['tecnologia'] == 14 && ( strpos( $this->after('-',$_GET['juntor']) , 'KHOMP') !== false )){ //Analógico-KHOMP
                     $entity = $this->entity->find($id);
                     $entity2 = $this->entity2->find($id);
                     $entity->update([
                        'fabricante' => isset($_GET['juntor']) ? $this->after('-',$_GET['juntor']) : null,
                        'nome' =>  isset($_GET['nome']) ? $_GET['nome'] : null,
                        'tecnologia' =>  isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                        //'tipo' =>  isset($_GET['tipo']) ? $_GET['tipo'] : null,
                        'juntor' =>  isset($_GET['juntor']) ? $_GET['juntor'] : null,
                        'rota' =>  isset($_GET['rota']) ? $_GET['rota'] : null,
                        'rota_dir' =>  isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                        'prefx_entrada' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                        'prefx_saida' => isset($_GET['prefx_saida']) ? $_GET['prefx_saida'] : null,
                        'juntor_cod_acess' =>  isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess'] : null,
                        'juntor_atend' =>  isset($_GET['juntor_atend']) ? $_GET['juntor_atend'] : null,
                        'prefx_juntor' => isset($_GET['prefx_juntor'])? $_GET['prefx_juntor'] : null,            
                        'fidelidade' =>  isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null 

                     ]);
                      
                     $entity2->update ([
                      'context_fxo' => isset($_GET['context_fxo'])? $_GET['context_fxo'] : null ,
                      'context_fxo_alt' => isset($_GET['context_fxo_alt'])? $_GET['context_fxo_alt'] : null ,
                      'fxo_fsk_detection' => isset($_GET['fxo_fsk_detection'])? $_GET['fxo_fsk_detection'] : null ,
                      'fxo_fsk_timeout' => isset($_GET['fxo_fsk_timeout'])? $_GET['fxo_fsk_timeout'] : null ,
                      'fxo_user_xfer_delay' => isset($_GET['fxo_user_xfer_delay'])? $_GET['fxo_user_xfer_delay'] : null ,
                      'fxo_send_pre_audio' => isset($_GET['fxo_send_pre_audio'])? $_GET['fxo_send_pre_audio'] : null ,
                      'fxo_busy_disconnection' => isset($_GET['fxo_busy_disconnection'])? $_GET['fxo_busy_disconnection'] : null ,
                         ]);
                
            }

            else if($_GET['tecnologia'] == 11 ){ //TECNOLOGIA IP
                     $codArea = DB::table("parametros")->select('codArea')->first()->codArea;
                     if(isset($_GET['prefx_saida'])){
                          switch($_GET['prefx_saida']){
                              case '11':
                                $prefx_saida = '0';
                              break;
                              case '12': 
                                $prefx_saida = '55';
                              break;
                              case '13': 
                                $prefx_saida = '550';
                              break;
                              case '14':
                                $prefx_saida = '550'.$codArea;
                              break;
                              case '15':
                                $prefx_saida = '0'.$codArea;
                              break;
                              case '16':
                                 $prefx_saida = $codArea;
                              break;
                              case '17':
                                 $prefx_saida = '55'.$codArea;
                              break;
                              default:
                                $prefx_saida = '';
                              break;
                          }
                     }

                     $entity = $this->entity->find($id);
                     $entity3 = $this->entity3->find($id);

                     $entity->update([
                        'nome' =>             isset($_GET['nome']) ? $_GET['nome'] : null,
                        'tecnologia' =>       isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                        //'tipo' => isset($_GET['tipo']) ? $_GET['tipo'] : null,
                        'rota' =>             isset($_GET['rota']) ? $_GET['rota'] : null,
                        'juntor_atend' =>     isset($_GET['juntor_atend']) ? $_GET['juntor_atend'] : null,
                        'juntor_cod_acess' => isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess'] : null,
                        'rota_dir' =>         isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                        'prefx_entrada' =>    isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                        'prefx_saida' =>      isset($prefx_saida) ? $prefx_saida : null,
                        'fidelidade' =>       isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null,
                        'remover_prefixo' =>  isset($_GET['remover_prefixo'] ) ? $_GET['remover_prefixo'] : null
                     ]);
                     

                     $entity3->update ([             
                        'conta_registro' => isset($_GET['conta_registro']) ? $_GET['conta_registro'] : null,   
                        'senha_registro'=>  isset($_GET['senha_registro']) ? $_GET['senha_registro'] : null,  
                        'dominio' =>        isset($_GET['dominio']) ? $_GET['dominio'] : null,  
                        'host'=>            isset($_GET['host']) ? $_GET['host'] : null,  
                        'proxy'=>           isset($_GET['proxy']) ? $_GET['proxy'] : null,  
                        'protocolo' =>      isset($_GET['protocolo']) ? $_GET['protocolo'] : null,  
                        'reenc_chamadas'=>  isset($_GET['reenc_chamadas']) ? $_GET['reenc_chamadas'] : null,  
                        'qualify' =>        isset($_GET['qualify']) ? $_GET['qualify'] : null,  
                        'reinvite'=>        isset($_GET['reinvite']) ? $_GET['reinvite'] : null,  
                        'pro_band'=>        isset($_GET['pro_band']) ? $_GET['pro_band'] : null,  
                        'tipo'=>            isset($_GET['type']) ? $_GET['type'] : null,  
                        'nat'=>             isset($_GET['nat']) ? $_GET['nat'] : null,  
                        'dtmf_mode'=>       isset($_GET['dtmf_mode']) ? $_GET['dtmf_mode'] : null,  
                        'insecure'=>        isset($_GET['insecure']) ? $_GET['insecure'] : null,  
                        'contexto'=>        isset($_GET['contexto']) ? $_GET['contexto'] : null,  
                        'porta'=>           isset($_GET['porta']) ? $_GET['porta'] : null,  
                     ]);
                                   
            }        
                    //Session::flash('message_type', 'success');
                    //Session::flash('message_text', 'Dados atualizados com sucesso!');
            $this->atualizaArquivo();
            return redirect()->route('admin.troncos.index');    
    }   
            

    public function store(){               
    $troncos = new Troncos;
    $attr_avanc_khomp = new attr_avanc_khomp;
    

    if( isset($_GET['juntor']) && (strpos( $this->after('-',$_GET['juntor']) , 'KHOMP') !== false )  &&  ($_GET['tecnologia'] == 12) ){ // GSM-KHOMP
             $troncosr = $troncos->create([
                'fabricante' =>       isset($_GET['juntor']) ? $this->after('-',$_GET['juntor']) : null,
                'nome' =>             isset($_GET['nome']) ? $_GET['nome'] : null,
                'tecnologia' =>       isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                //'tipo' =>  isset($_GET['tipo']) ? $_GET['tipo'] : null,
                'juntor' =>           isset($_GET['juntor']) ? $_GET['juntor'] : null,
                'rota' =>             isset($_GET['rota']) ? $_GET['rota'] : null,
                'rota_dir' =>         isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                'prefx_entrada' =>    isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                'prefx_saida' =>      isset($_GET['prefx_saida']) ? $_GET['prefx_saida'] : null,
                'juntor_cod_acess' => isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess'] : null,
                'juntor_atend' =>     isset($_GET['juntor_atend'] ) ? $_GET['juntor_atend'] : null,
                'fidelidade' =>       isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null,
             ]);
              
             $attr_avanc_khompr = $attr_avanc_khomp->create ([
                'id' => $troncosr->id,
                'ccss_enable'=>           isset($_GET['ccss_enable'] ) ? $_GET['ccss_enable'] : null ,
                'audio_rx_sync'=>         isset($_GET['audio_rx_sync'] ) ? $_GET['audio_rx_sync'] : null ,
                'context_gsm_call'=>      isset($_GET['context_gsm_call'] ) ?$_GET['context_gsm_call'] : null ,
                'context_gsm_sms'=>       isset($_GET['context_gsm_sms'] ) ? $_GET['context_gsm_sms'] : null ,
                'volume_tx'=>             isset($_GET['volume_tx_v'] ) ? $_GET['volume_tx'] : null ,
                'volume_rx'=>             isset($_GET['volume_rx_v'] ) ? $_GET['volume_rx'] : null ,
                'suprimir_id'=>           isset($_GET['suprimir_id'] ) ? $_GET['suprimir_id'] : null ,
                'block_call'=>            isset($_GET['block_call'] ) ? $_GET['block_call'] : null ,
                'disconnect_call'=>       isset($_GET['disconnect_call'] ) ? $_GET['disconnect_call'] : null ,
                'co_dialtone'=>           isset($_GET['co_dialtone'] ) ? $_GET['co_dialtone'] : null ,
                'vm_dialtone'=>           isset($_GET['vm_dialtone'] ) ? $_GET['vm_dialtone'] : null ,
                'pbx_dialtone'=>          isset($_GET['pbx_dialtone'] ) ? $_GET['pbx_dialtone'] : null ,
                'fast_busy'=>             isset($_GET['fast_busy'] ) ? $_GET['fast_busy'] : null ,
                'ring_back'=>             isset($_GET['ring_back'] ) ? $_GET['ring_back'] : null ,
                'waiting_call'=>          isset($_GET['waiting_call'] ) ? $_GET['waiting_call'] : null ,
                'ring'=>                  isset($_GET['ring'] ) ? $_GET['ring'] : null ,
                'context_digital'=>       isset($_GET['context_digital'] ) ? $_GET['context_digital'] : null ,
                'language'=>              isset($_GET['language'] ) ? $_GET['language'] : null ,
                'mohclass'=>              isset($_GET['mohclass'] ) ? $_GET['mohclass'] : null ,
                'flash_behaviour'=>       isset($_GET['flash_behaviour'] ) ? $_GET['flash_behaviour']: null ,
                'pendulum_digits'=>       isset($_GET['pendulum_digits'] ) ? $_GET['pendulum_digits'] : null ,
                'pendulum_hu_digits'=>    isset($_GET['pendulum_hu_digits'] ) ? $_GET['pendulum_hu_digits'] : null,
            ]);

    } else if(( isset($_GET['juntor']) && strpos( $this->after('-',$_GET['juntor']) , 'KHOMP') !== false )  &&  ($_GET['tecnologia'] == 13)){ //DIGITAL KHOMP
                $troncosr = $troncos->create([
                'fabricante' => isset($_GET['juntor']) ? $this->after('-',$_GET['juntor']) : null,
                'nome' =>  isset($_GET['nome']) ? $_GET['nome'] : null,
                'tecnologia' =>  isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                //'tipo' =>  isset($_GET['tipo']) ? $_GET['tipo'] : null,
                'juntor' =>  isset($_GET['juntor']) ? $_GET['juntor'] : null,
                'rota' =>  isset($_GET['rota']) ? $_GET['rota'] : null,
                'rota_dir' =>  isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                'prefx_entrada' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                'prefx_saida' => isset($_GET['prefx_saida']) ? $_GET['prefx_saida'] : null,
                'juntor_cod_acess' =>  isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess']: null,
                'juntor_atend' =>  isset($_GET['juntor_atend'] ) ? $_GET['juntor_atend'] : null,
                'fidelidade' =>  isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null,
             ]);
              
             $attr_avanc_khompr = $attr_avanc_khomp->create ([
                'id' => $troncosr->id,
                'ccss_enable'=> isset($_GET['ccss_enable'] ) ? $_GET['ccss_enable'] : null ,
                'audio_rx_sync'=> isset($_GET['audio_rx_sync'] ) ? $_GET['audio_rx_sync'] : null ,
                //'context_gsm_call'=> isset($_GET['context_gsm_call'] ) ?$_GET['context_gsm_call']) : null ,
                //'context_gsm_sms'=> isset($_GET['context_gsm_sms'] ) ? $_GET['context_gsm_sms']) : null ,
                'volume_tx'=> isset($_GET['volume_tx'] ) ? $_GET['volume_tx'] : null ,
                'volume_rx'=> isset($_GET['volume_rx'] ) ? $_GET['volume_rx'] : null ,
                'suprimir_id'=> isset($_GET['suprimir_id'] ) ? $_GET['suprimir_id'] : null ,
                'block_call'=> isset($_GET['block_call'] ) ? $_GET['block_call'] : null ,
                'disconnect_call'=> isset($_GET['disconnect_call'] ) ? $_GET['disconnect_call'] : null ,
                'co_dialtone'=> isset($_GET['co_dialtone'] ) ? $_GET['co_dialtone'] : null ,
                'vm_dialtone'=> isset($_GET['vm_dialtone'] ) ? $_GET['vm_dialtone'] : null ,
                'pbx_dialtone'=> isset($_GET['pbx_dialtone'] ) ? $_GET['pbx_dialtone'] : null ,
                'fast_busy'=> isset($_GET['fast_busy'] ) ? $_GET['fast_busy'] : null ,
                'ring_back'=> isset($_GET['ring_back'] ) ? $_GET['ring_back'] : null ,
                'waiting_call'=> isset($_GET['waiting_call'] ) ? $_GET['waiting_call'] : null ,
                'ring'=> isset($_GET['ring'] ) ? $_GET['ring'] : null ,
                'context_digital'=> isset($_GET['context_digital'] ) ? $_GET['context_digital'] : null ,
                'language'=> isset($_GET['language'] ) ? $_GET['language'] : null ,
                'mohclass'=> isset($_GET['mohclass'] ) ? $_GET['mohclass'] : null ,
                'flash_behaviour'=> isset($_GET['flash_behaviour'] ) ? $_GET['flash_behaviour'] : null ,
                'pendulum_digits'=> isset($_GET['pendulum_digits'] ) ? $_GET['pendulum_digits'] : null ,
                'pendulum_hu_digits'=> isset($_GET['pendulum_hu_digits'] ) ? $_GET['pendulum_hu_digits'] : null 
            ]);

             if( isset($_GET['cad_stringbuffer']) && isset($troncosr) && $_GET['cad_stringbuffer'] ){
             $this->setCadencias($_GET['cad_stringbuffer'], $troncosr);
             }
                               

            //return view('admin.troncos.index');
    } else if(( isset($_GET['juntor']) && strpos( $this->after('-',$_GET['juntor']) , 'KHOMP') !== false )  &&  ($_GET['tecnologia'] == 14)){ //Analógico-KHOMP
             
             $troncosr = $troncos->create([
                'fabricante' => isset($_GET['juntor']) ? $this->after('-',$_GET['juntor']) : null,
                'nome' =>  isset($_GET['nome']) ? $_GET['nome'] : null,
                'tecnologia' =>  isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                'tipo' =>  isset($_GET['tipo']) ? $_GET['tipo'] : null,
                'juntor' =>  isset($_GET['juntor']) ? $_GET['juntor'] : null,
                'rota' =>  isset($_GET['rota']) ? $_GET['rota'] : null,
                'rota_dir' =>  isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                'prefx_entrada' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                'prefx_saida' => isset($_GET['prefx_saida']) ? $_GET['prefx_saida'] : null,
                'juntor_cod_acess' =>  isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess'] : null,
                'juntor_atend' =>  isset($_GET['juntor_atend']) ? $_GET['juntor_atend'] : null,
                'prefx_juntor' => isset($_GET['prefx_juntor'])? $_GET['prefx_juntor'] : null,
                'fidelidade' =>  isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null,
                'remover_prefixo' =>  isset($_GET['remover_prefixo'] ) ? $_GET['remover_prefixo'] : null 
             ]);
         

             $attr_avanc_khompr = $attr_avanc_khomp->create ([
                'id' => $troncosr->id,
                'context_fxo' => isset($_GET['context_fxo'])? $_GET['context_fxo'] : null ,
                'context_fxo_alt' => isset($_GET['context_fxo_alt'])? $_GET['context_fxo_alt'] : null ,
                'fxo_fsk_detection' => isset($_GET['fxo_fsk_detection'])? $_GET['fxo_fsk_detection'] : null ,
                'fxo_fsk_timeout' => isset($_GET['fxo_fsk_timeout'])? $_GET['fxo_fsk_timeout'] : null ,
                'fxo_user_xfer_delay' => isset($_GET['fxo_user_xfer_delay'])? $_GET['fxo_user_xfer_delay'] : null ,
                'fxo_send_pre_audio' => isset($_GET['fxo_send_pre_audio'])? $_GET['fxo_send_pre_audio'] : null ,
                'fxo_busy_disconnection' => isset($_GET['fxo_busy_disconnection'])? $_GET['fxo_busy_disconnection'] : null ,

             ]);
        

           

    }

    else if($_GET['tecnologia'] == 11){ //TECNOLOGIA IP
             $codArea = DB::table("parametros")->select('codArea')->first()->codArea;
             if(isset($_GET['prefx_saida'])){
                  switch($_GET['prefx_saida']){
                      case '11':
                        $prefx_saida = '0';
                      break;
                      case '12': 
                        $prefx_saida = '55';
                      break;
                      case '13': 
                        $prefx_saida = '550';
                      break;
                      case '14':
                        $prefx_saida = '550'.$codArea;
                      break;
                      case '15':
                        $prefx_saida = '0'.$codArea;
                      break;
                      case '16':
                        $prefx_saida = $codArea;
                      break;
                      default:
                                $prefx_saida = '';
                      break;
                  }
             }

             $attr_troncos_ip = new attr_troncos_ip;
             $troncosr = $troncos->create([
                'nome' =>isset($_GET['nome'])? $_GET['nome'] : null ,
                'tecnologia' =>isset($_GET['tecnologia'])? $_GET['tecnologia'] : null ,
                //'tipo' => isset($_GET['tipo'])? $_GET['tipo'] : null ,
                'rota' => isset($_GET['rota'])? $_GET['rota'] : null ,
                'juntor_atend' => isset($_GET['juntor_atend'])? $_GET['juntor_atend'] : null ,
                'juntor_cod_acess' => isset($_GET['juntor_cod_acess'])? $_GET['juntor_cod_acess'] : null ,
                'rota_dir' => isset($_GET['rota_dir'])? $_GET['rota_dir'] : null ,
                'prefx_entrada' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                'prefx_saida' => isset($prefx_saida) ? $prefx_saida : null,
                'fidelidade' =>  isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null,
                'remover_prefixo' =>  isset($_GET['remover_prefixo']) ? $_GET['remover_prefixo'] : null 
             ]);
             

             $attr_troncos_ipr = $attr_troncos_ip->create ([             
                'id' => $troncosr->id,
                'conta_registro' => isset($_GET['conta_registro'])? $_GET['conta_registro'] : null,
                'senha_registro'=> isset($_GET['senha_registro'])? $_GET['senha_registro'] : null,
                'dominio' => isset($_GET['dominio'])? $_GET['dominio'] : null,
                'host'=> isset($_GET['host'])? $_GET['host'] : null,
                'proxy'=>isset($_GET['proxy'])? $_GET['proxy'] : null,
                'protocolo' => isset($_GET['protocolo'])? $_GET['protocolo'] : null,
                'reenc_chamadas'=> isset($_GET['reenc_chamadas'])? $_GET['reenc_chamadas'] : null,
                'qualify' => isset($_GET['qualify'])? $_GET['qualify'] : null,
                'reinvite' =>isset($_GET['reinvite'])? $_GET['reinvite'] : null,
                'pro_band'=> isset($_GET['pro_band'])? $_GET['pro_band'] : null,
                'tipo'=> isset($_GET['type'])? $_GET['type'] : null,
                'nat'=> isset($_GET['nat'])? $_GET['nat'] : null,
                'dtmf_mode'=> isset($_GET['dtmf_mode'])? $_GET['dtmf_mode'] : null,
                'insecure'=> isset($_GET['insecure'])? $_GET['insecure'] : null,
                'contexto'=> isset($_GET['contexto'])? $_GET['contexto'] : null,
                'porta'=>  isset($_GET['porta']) ? $_GET['porta'] : null
             ]);
        
           
    } else if( 
    (
    strpos($this->after('-',$_GET['juntor']) , 'Digivoice' ) !== false 
    || 
    strpos($this->after('-',$_GET['juntor']) , 'Dahdi' ) !== false 
    )  
    ||  
    ($_GET['tecnologia'] == 15)){ //DIGIVOICE OU LEGADO
        
          $troncosr = $troncos->create([
                'fabricante' => isset($_GET['juntor']) ? $this->after('-',$_GET['juntor']) : null,
                'nome' =>  isset($_GET['nome']) ? $_GET['nome'] : null,
                'tecnologia' =>  isset($_GET['tecnologia']) ? $_GET['tecnologia'] : null,
                'tipo' =>  isset($_GET['tipo']) ? $_GET['tipo'] : null,
                'juntor' =>  isset($_GET['juntor']) ? $_GET['juntor'] : null,
                'rota' =>  isset($_GET['rota']) ? $_GET['rota'] : null,
                'rota_dir' =>  isset($_GET['rota_dir']) ? $_GET['rota_dir'] : null,
                'prefx_entrada' => isset($_GET['prefx_entrada']) ? $_GET['prefx_entrada'] : null,
                'prefx_saida' => isset($_GET['prefx_saida']) ? $_GET['prefx_saida'] : null,
                'juntor_cod_acess' =>  isset($_GET['juntor_cod_acess']) ? $_GET['juntor_cod_acess'] : null,
                'juntor_atend' =>  isset($_GET['juntor_atend']) ? $_GET['juntor_atend'] : null,
                'prefx_juntor' => isset($_GET['prefx_juntor'])? $_GET['prefx_juntor'] : null,
                'fidelidade' =>  isset($_GET['fidelidade'] ) ? $_GET['fidelidade'] : null           
            ]);
                 
    }       

    
    $this->atualizaArquivo();

    return redirect()->route('admin.troncos.index');     

}
    
    
    public function destroy(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();
        $pfController = new PrefixosController;
        $pfController->removerTroncoDeTodos($id);


        #Deleta os troncos na white_list
        $white_list_class = new WhiteList;
        $white_lists = $white_list_class->all();
        
        foreach ($white_lists as $wl){
          $troncos = explode(',',$wl->tronco);
          if( ($item = array_search($id, $troncos)) !== FALSE ){
             unset($troncos[$item]);
             $wl->update([' tronco' => implode(',',$troncos) ]);
          }  
        }
                
        #Deleta os troncos na black_list
        $black_list_class = new BlackList;
        $black_list = $black_list_class->all();
        foreach ($black_list as $bl){
          $troncos = explode(',',$bl->tronco);
          if( ($item = array_search($id, $troncos)) !== FALSE ){
             unset($troncos[$item]);
             $bl->update([' tronco' => implode(',',$troncos) ]);
          }  
        }

        #Deleta da tabela de Destinos
        $destinos_class = new Destinos;
        $destinos = $destinos_class->all();
        foreach ($destinos as $dest){
          $troncos = explode(',',$dest->troncos);
          if( ($item = array_search($id, $troncos)) != FALSE ){
             unset($troncos[$item]);
             $dest->update(['tronco' => implode(',',$troncos)]);
          }  
        }

        $this->atualizaArquivo();
        return response()->json(['status'=>$id]);
    }
    
 
    public function getCadencias($id){
    $cadenciaClass = new Cadencias;
    
    $cadencias = $cadenciaClass->select('nome' ,'valor', 'id')->where('parent_id', '=', $id)->get();
    
    if(count($cadencias))
    return $cadencias;

    return 0;
    }

    public function delCadencias($id){
    
    $cadenciaClass = new Cadencias;
    $status = $cadenciaClass->where('id', '=', $id)->delete();
    return $status;
    }


  
    function para_array($texto) {
    $resultado = array();
    $partes = explode(",", $texto); // quebra em assinalamentos
    foreach ($partes as $parte) {
        list($chave, $valor) = explode("=", $parte); // separa chave e valor
        $resultado[ $chave ] = $valor;
    }
    return $resultado;

    }

   public function strrevpos($instr, $needle)
        {
             $rev_pos = strpos (strrev($instr), strrev($needle));
             if ($rev_pos===false) return false;
             else return strlen($instr) - $rev_pos - strlen($needle);
        }


    public function before_last ($esse, $inthat)
        {
            return substr($inthat, 0, $this->strrevpos($inthat, $esse));
        }

    
    
    public function after_last ($esse, $inthat)
        {
            if (!is_bool($this->strrevpos($inthat, $esse)))
            return substr($inthat, $this->strrevpos($inthat, $esse)+strlen($esse));
        }
     

    public function after($chave, $inthat) {
     if (!is_bool(strpos($inthat, $chave)))
     return substr($inthat, strpos($inthat,$chave)+strlen($chave));
    }
    
    public function before($esse, $inthat){
      return substr($inthat, 0, strpos($inthat, $esse));
    }


    public function atualizaArquivo(){
      $arquivo_sip = "/etc/asterisk/sip_troncos2.conf";
      $arquivo_iax = "/etc/asterisk/iax_troncos2.conf";

      $handle_sip = fopen($arquivo_sip, 'w');
      $handle_iax = fopen($arquivo_iax, 'w');
     

      $troncos_ip = DB::table('troncos')->where('troncos.tecnologia', '=', '11')
                                          ->join('attr_troncos_ip', 'attr_troncos_ip.id', '=', 'troncos.id')->get();

      $txt_sip = '';
      $txt_iax = '';

      $pula = chr(13).chr(10);
      

      foreach($troncos_ip as $key=>$tronco){
           if($tronco->protocolo == 11){
              
              $txt_sip .=  $pula.
                      '['.$tronco->nome.'](template_tronco)'.$pula.
                      'username='.$tronco->conta_registro.$pula.
                      'secret='.$tronco->senha_registro.$pula.
                      'fromuser='.$tronco->conta_registro.$pula.
                      'host='.$tronco->host.$pula.
                      'domain='.$tronco->dominio.$pula.
                      'fromdomain='.$tronco->proxy.$pula.
                      'canreinvite='.($tronco->reinvite == 1 ? 'YES' : 'NO').$pula.
                      'callerid="" <>'.$pula;

           } else if($tronco->protocolo == 12) {
              
              $txt_iax .=  $pula.
                      '['.$tronco->nome.'](template_tronco)'.$pula.
                      'username='.$tronco->conta_registro.$pula.
                      'secret='.$tronco->senha_registro.$pula.
                      'fromuser='.$tronco->conta_registro.$pula.
                      'host='.$tronco->host.$pula.
                      'domain='.$tronco->dominio.$pula.
                      'fromdomain='.$tronco->proxy.$pula.
                      'canreinvite='.($tronco->reinvite == 1 ? 'YES' : 'NO').$pula.
                      'callerid="" <>'.$pula;

           } else if($tronco->protocolo == 14) {
              $txt_sip .=  $pula.
                      '['.$tronco->nome.'](template_tronco)'.$pula.
                      'username='.$tronco->conta_registro.$pula.
                      'secret='.$tronco->senha_registro.$pula.
                      'fromuser='.$tronco->conta_registro.$pula.
                      'host='.$tronco->host.$pula.
                      'domain='.$tronco->dominio.$pula.
                      'fromdomain='.$tronco->proxy.$pula.
                      'canreinvite='.($tronco->reinvite == 1 ? 'YES' : 'NO').$pula.
                      'callerid="" <>'.$pula;

              $txt_iax .=  $pula.
                      '['.$tronco->nome.'](template_tronco)'.$pula.
                      'username='.$tronco->conta_registro.$pula.
                      'secret='.$tronco->senha_registro.$pula.
                      'fromuser='.$tronco->conta_registro.$pula.
                      'host='.$tronco->host.$pula.
                      'domain='.$tronco->dominio.$pula.
                      'fromdomain='.$tronco->proxy.$pula.
                      'canreinvite='.($tronco->reinvite == 1 ? 'YES' : 'NO').$pula.
                      'callerid="" <>'.$pula;
           }
      }

      fwrite($handle_sip, $txt_sip);
      fwrite($handle_iax, $txt_iax);

      fclose($handle_iax);
      fclose($handle_sip);

    }

    public function teste(){
      
    
      return $codArea;
    }
} 
   

 