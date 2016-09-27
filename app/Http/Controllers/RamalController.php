<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Ramal;
use App\Models\Grupos;
use App\Models\ProfileRamal;
use App\Models\RamalSetting;
use App\Http\Controllers\DatatablesController;
use Response;

class RamalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Ramal $entity, ProfileRamal $profileRamal){

        $this->entity = new $entity;
        $this->profileRamal = new $profileRamal;
        $this->middleware('auth');

    }

    public function index(){
        return view('admin.ramais.index');
    }
    public function create(){       
        return view('admin.ramais.create', compact ('name'));
    }

    public function store(){
        $ramal_array = [
        'tipo' => isset($_GET['tipo']) ? $_GET['tipo'] : null,
            'nome' => isset($_GET['nome']) ? $_GET['nome'] : null,
            'tecnologia' => isset($_GET['tec']) ? $_GET['tec'] : null,
            'aplicacao' => isset($_GET['app']) ? $_GET['app'] : null,
            'ddr' => isset($_GET['ddr']) ? $_GET['ddr'] : null,
            'no_externo' => isset($_GET['no_externo']) ? $_GET['no_externo'] : null,            
            'numero' => isset($_GET['number']) ? $_GET['number'] : null,
            'senha' => isset($_GET['password']) ? $_GET['password'] : null,
            'capturar' => isset($_GET['capture']) ? '1' : '0',
            'estacionar_chamadas' => isset($_GET['parking_calls']) ? '1' : '0',
            'desvio_tipo' => isset($_GET['deviation']) ? $_GET['deviation'] : null,
            'desvio_para' => isset($_GET['detour']) ? $_GET['detour'] : null,
            'nao_perturbe' => isset($_GET['notdisturb']) ? '1' : '0',
            'conferencia' => isset($_GET['conference']) ?  '1' : '0',
            'codigo_conta' => isset($_GET['accountcode']) ?  '1' : '0',
            'central' => isset($_GET['central']) ?  $_GET['central'] : '0',
            'centro_custo' => isset($_GET['centercost']) ? '1' : '0',
            'acesso_porteiro' => isset($_GET['intercomaccess']) ?  '1' : '0',
            'nat'=> isset($_GET['nat']) ? '1' : '0',
            'porta' => isset($_GET['porta']) ? $_GET['porta'] : null
            ];

            if($_GET['tipo'] == 39)
            {
                  if( $_GET['app'] == 111 || $_GET['app'] == 116)
                  {
                      $ramal_array['profile_ramal_id'] = $_GET['profile'];
                  }
            }
            
            $ramal = $this->entity->create($ramal_array);
        
        

     $this->atualizaArquivo();        

     return redirect()->route('admin.ramais.index');
    }
     
    public function edit($id){
        
        //$masters = RamalSetting::getMasters();
        $entity = $this->entity->find($id);
        //$profiles = $this->profileRamal->to_form_select('id');
    
        echo (json_encode($this->entity->find($id)));
       
        //return view('admin.ramais.edit', compact('entity', 'profiles','masters'));
    }

    public function update($id) {
       
        $ramal = $this->entity->find($id);

        $ramal->update([
            'tipo' => isset($_GET['tipo']) ? $_GET['tipo'] : null,
            'nome' => isset($_GET['nome']) ? $_GET['nome'] : null,
            'tecnologia' => isset($_GET['tec']) ? $_GET['tec'] : null,
            'aplicacao' => isset($_GET['app']) ? $_GET['app'] : null,
            'ddr' => isset($_GET['ddr']) ? $_GET['ddr'] : null,
            'no_externo' => isset($_GET['no_externo']) ? $_GET['no_externo'] : null,            
            'numero' => isset($_GET['number']) ? $_GET['number'] : null,
            'senha' => isset($_GET['password']) ? $_GET['password'] : null,
            'capturar' => isset($_GET['capture']) ? '1' : '0',
            'estacionar_chamadas' => isset($_GET['parking_calls']) ? '1' : '0',
            'desvio_tipo' => isset($_GET['deviation']) ? $_GET['deviation'] : null,
            'desvio_para' => isset($_GET['detour']) ? $_GET['detour'] : null,
            'nao_perturbe' => isset($_GET['notdisturb']) ? '1' : '0',
            'central' => isset($_GET['central']) ?  $_GET['central'] : '0',
            'conferencia' => isset($_GET['conference']) ?  '1' : '0',
            'codigo_conta' => isset($_GET['accountcode']) ?   '1' : '0',
            'centro_custo' => isset($_GET['centercost']) ? '1' : '0',
            'acesso_porteiro' => isset($_GET['intercomaccess']) ?  '1' : '0',
            'nat'=> isset($_GET['nat']) ? '1' : '0',
            'profile_ramal_id' => isset($_GET['profile']) ? $_GET['profile'] : null,
            'porta' => isset($_GET['porta']) ? $_GET['porta'] : null
        ]);
     
     if($ramal->tipo == 39)
     {
         if( $ramal->app == 111 || $ramal->app == 116)
        {
             $ramal->update([
              'profile_ramal_id' => $_GET['profile']
              ]);
         }
    }
    
     $this->atualizaArquivo();        
      
     Session::flash('message_type', 'success');
     Session::flash('message_text', 'Ramal atualizado com sucesso!');
     return redirect()->route('admin.ramais.index');
    
    }

   public function destroy(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();     
        $this->atualizaArquivo();
        
        //deleta os ramais dos grupos
        $grupos = new Grupos;
        $todos_grupos = $grupos->all();
        
        foreach ($todos_grupos as $grupo){
          $ramais = explode(',',$grupo->ramais);
          if( ($item = array_search($id, $ramais)) !== FALSE ){
             unset($ramais[$item]);
             $grupo->update(['ramais' => implode(',',$ramais) ]);
          }  
        }

        return response()->json(['status'=>$id]); 
   }   
  
  public function getGrupos($profileid){ //pega os atributos do perfil que vão no arquivo
     $entity = $this->profileRamal->find($profileid)->select('grupo_captura', 'captura_grupos')->first();    
     $groups[0] = $entity->grupo_captura;
     $groups[1] = $entity->captura_grupos;
     return ($groups); 
  }

  public function escreveSip($ramal){
    $handle = fopen("/etc/asterisk/sip_ramais.conf", "a");
    $grupos = isset($ramal->profile_ramal_id) ? $this->getGrupos($ramal->profile_ramal_id) : null;
    
    if (isset($grupos))
    {
        $grupo_captura = $grupos[0];
        $captura_grupos = $grupos[1];
        $groups = 'pickupgroup='.    $grupo_captura.chr(13).chr(10).
                  'callgroup='.      $captura_grupos.chr(13).chr(10).chr(13).chr(10);
    }
    else
    {
    $groups ='' ;
    }
     
      fwrite($handle,        chr(13).chr(10).'[' .$ramal->numero. ']'.'(template)' .chr(13).chr(10).
                                        'username='.       $ramal->numero   .chr(13).chr(10).
                                        'secret='.         $ramal->senha   .chr(13).chr(10).
                                        'nat='.            ($ramal->nat == 1 ? 'yes' : 'no')   .chr(13).chr(10).
                                        'callerid="'.      $ramal->nome.'" '. '<'. $ramal->numero .'>'.chr(13).chr(10).
                                        $groups
      );

      fclose($handle);
  }

  public function escreveIax($ramal){
    $handle = fopen("/etc/asterisk/iax_ramais.conf", "a");
    $grupos = isset($ramal->profile_ramal_id) ? $this->getGrupos($ramal->profile_ramal_id) : null;

    if (isset($grupos))
    {
        $grupo_captura = $grupos[0];
        $captura_grupos = $grupos[1];
        $groups = 'pickupgroup='.    $grupo_captura.chr(13).chr(10).
                  'callgroup='.      $captura_grupos.chr(13).chr(10).chr(13).chr(10);
    }
    else
    {
    $groups = '' ;
    }

        fwrite($handle,          chr(13).chr(10).'[' .$ramal->numero. ']'.'(template)' .chr(13).chr(10).
                                        'username='.       $ramal->numero   .chr(13).chr(10).
                                        'secret='.         $ramal->senha   .chr(13).chr(10).
                                        'nat='.            ($ramal->nat == 1 ? 'yes' : 'no')  .chr(13).chr(10).
                                        'callerid="'.      $ramal->nome.'" '. '<'. $ramal->numero .'>'.chr(13).chr(10).
                                        $groups
        );
                    
       fclose($handle);
  }           

  public function escreveFxs($ramal){
   $arquivo = '/etc/asterisk/khomp_fxs.conf';


   $grupos = isset($ramal->profile_ramal_id) ? $this->getGrupos($ramal->profile_ramal_id) : null;
   $grupo_captura = $grupos[0];
   $captura_grupos = $grupos[1];

   //15=calleridnum: 215 |calleridname:Portaria| callgroup: 0 | pickupgroup: 0

   $string  = $ramal->porta.'= calleridnum: '.$ramal->numero.' |calleridname:'.$ramal->nome.'| callgroup: '.$captura_grupos.' | pickupgroup: '.$grupo_captura.chr(13).chr(10);
   
   if(file_exists($arquivo)){
        if(!is_writable($arquivo)){
           shell_exec('chmod 777 '.$arquivo);
        }
   }

   file_put_contents($arquivo, $string, FILE_APPEND);
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
    
    public function getAll(){
       $ramais = $this->entity->all();
       return $ramais;
    }
   
   public function resetaArquivo(){
      $arq1 = '/etc/asterisk/sip_ramais.conf';
      $arq2 = '/etc/asterisk/iax_ramais.conf';
      $arq3 = "/etc/asterisk/khomp_fxs.conf";

      file_put_contents($arq1, '');
      file_put_contents($arq2, '');
      file_put_contents($arq3, '');
   }

   public function atualizaArquivo(){
      //Atualização 19/09/2016
      //Somente PABX escreve nos arquivos

      $this->resetaArquivo();
      $ramais = $this->getAll();
      

      foreach($ramais as $r){
         

         if($r->tecnologia == '12' && $r->aplicacao == '111'){
            $this->escreveSip($r);
         }
   
        else if($r->tecnologia == '13' && $r->aplicacao == '111'){
            $this->escreveIax($r);
         }
   
        else if($r->tecnologia == '14' && $r->aplicacao == '111'){
            $this->escreveSip($r);
            $this->escreveIax($r);
        }

        else if($r->tecnologia == '15'){
           $this->escreveFxs($r);
        }

        shell_exec("rasterisk -x 'reload'");
    }
  }

}