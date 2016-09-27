<?php

namespace App\Http\Controllers;

use App\Models\RamalSetting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Datatables;
use \Yajra\Datatables\Request as RequestDatatables;

use App\Models\User;
use App\Models\ViewUsers;
use App\Models\ViewGroups;
use App\Models\Ramal;
use App\Models\ViewProfileRamal;
use App\Models\attr_avanc_khomp;
use App\Models\attr_troncos_ip;
use App\Models\ProfileRamal;
use App\Models\Centrais;
use App\Models\Audios;
use App\Models\hardwares;
use App\Models\Troncos;
use App\Models\Saudacoes;
use App\Models\Uras;
use App\Models\Juntor;
use App\Models\BlackList;
use App\Models\Custos;
use App\Models\Grupos;
use App\Models\Codigos;
use App\Models\Voice_mail;
use App\Models\WhiteList;
use DB;

class DatatablesController extends Controller
{
    /**
     * Displays datatables front end view
     *
     * @return \Illuminate\View\View
     */
    public function getIndex()
    {
        return view('admin.datatables.index');
    }

    /**
     * Process datatables ajax request.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function getJuntor()
     {
        $data = DB::table('troncos', 'juntores')
                     ->select('*')
                     ->where('juntores.id', '=', '64');

        return ($data);
     }

    public function anyData($data)
    {
        $request = new RequestDatatables;
        $teste = new Datatables($request);

        return Datatables::of($data)->make(true);
    }

    public function dataAudios(){
        $audio = new Audios;
        $data = $audio->all();

        return $this->anyData($data);
    }

    public function dataBlackList(BlackList $bl)
    {
        $data = $bl->all();
        $entity = new Troncos;
        foreach ($data as &$d){
            $d->nomeTronco = '';
            $troncos = explode(',', $d->tronco);
                foreach($troncos as &$tronco){
                    $tr = $entity->find($tronco);
                    if($tr){
                    $d->nomeTronco .= $d->nomeTronco != '' ? ', '.$tr->nome : $tr->nome;
                    }
                }           
        }
   
        return $this->anyData($data);
    }

    public function dataWhiteList(WhiteList $wh)
    {
        $data = $wh->all();
        $entity = new Troncos;
        foreach ($data as &$d){
            $d->nomeTronco = '';
            
            $troncos = explode(',', $d->tronco);
                foreach($troncos as &$tronco){
                    $tr = $entity->find($tronco);
                    if($tr){
                    $d->nomeTronco .= $d->nomeTronco != '' ? ', '.$tr->nome : $tr->nome;
                    }
                }           
        }
   
        return $this->anyData($data);
    }

    public function dataCentrais()
    {
        $data = Centrais::select('centrais.*', DB::raw('troncos.nome as nome_tronco'))->join('troncos', 'troncos.id', '=', 'centrais.tronco');
   
        return $this->anyData($data);
    }

     public function dataSaudacoes()
    {
        $saudacoes_class = new Saudacoes;

        $data = $saudacoes_class->all();
   
        return $this->anyData($data);
    }

    public function dataCdr(){
        $data = DB::table('cdr')->select('*');
        return $this->anyData($data);
    }

    public function dataUsers(){
        $data = ViewUsers::select('*');
        return $this->anyData($data);
    }
    
    public function dataGroups(){
        $data = ViewGroups::select('*');
        return $this->anyData($data);
    }

    public function dataGrupos(){
        $grupos = Grupos::all();
        $ramais = Ramal::select('nome', 'id')->get();
        #dd($ramais);
        
        foreach ($grupos as &$grupo){
             $grupo->ramais = explode(',', $grupo->ramais);
             $array = [];
             
             foreach ($ramais as $ramal){
                  foreach ($grupo->ramais as $ramal_grupo){
                        if ($ramal_grupo == $ramal->id){
                              array_push($array, $ramal->nome);
                        }
                  }
             }

             $grupo->nomesRamais = implode(',', $array);
        }      
        #$grupo->nomesRamais = implode(',', $array); 
        return $this->anyData($grupos);
    } 

    public function dataRamais(Ramal $ramal){
        $data = $ramal::all();
        return $this->anyData($data);
    }

    public function dataUras(){
        $ura = new Uras;
        //$data = $ura::all()->join('horarios', 'uras.id', '=', 'horarios.id');
        $data = DB::table('uras')->select('uras.*' ,'ramais.nome as nome_ramal')->join('horarios', 'uras.id', '=', 'horarios.id')->join('ramais', 'uras.nome', '=','ramais.id');
        return $this->anyData($data);
    }

    public function dataProfilesRamais(ProfileRamal $profileRamal){
        /*$data = $profileRamal::all();
        return $this->anyData($data);*/
        $ramal = new Ramal;
        $ramais = $ramal->select('profile_ramal_id', 'nome')->get();
        $todos_profiles = $profileRamal::all();
        //dd($profiles_em_ramais);
       
         foreach ($todos_profiles as &$t){
                $t['dependentes'] = '';
                foreach ($ramais as $p){
                    if ($p->profile_ramal_id == $t->id)
                    {
                         $t['dependentes'] .= ';'.$p->nome;
                    } 
             }
        }
       //dd($todos_profiles);

        return $this->anyData($todos_profiles);
    }


    public function dataCodigos(){
         $codigo = new Codigos;
         $data = $codigo::all();
         return $this->anyData($data);
    }

    public function dataVoiceMail(){
         $voice_mail = new Voice_mail;
         
         $data = DB::table('voice_mail')
                      ->join('ramais', 'voice_mail.ramal','=', 'ramais.id')    
                      ->select(DB::raw("voice_mail.*,ramais.nome as nome_ramal, ramais.id as id_ramal, ramais.numero as numero_ramal"))->orderBy('voice_mail.created_at');

         //return json_encode($data);
         
         return $this->anyData($data);
    }

    public function dataCustos(){
         $custos = new Custos;
         $ramais = new Ramal;

         $data = $custos->all();
         
         foreach ($data as $key=>$custo){
            $custo->ramais = $ramais->select('id', 'nome')->where('centro_de_custo_id', '=', $custo->id)->get();
         }
         
         return $this->anyData($data);
    }

    public function dataHardwares(Hardwares $hardwares){
        $boards = $hardwares->orderBy('board', 'asc')->get();
        $juntores  = DB::table('juntores')->where('board_serial', '<>', '' )->get();
        
        $seriaisUsados = array();
        
        foreach($juntores as $j){
            if($j->board_serial != null){
                array_push($seriaisUsados, $j->board_serial);
            }       
        }  
        
        foreach ($boards as &$b){
            $b->dependencia = in_array($b->serial, $seriaisUsados);   
        }

        return $this->anyData($boards);
    }

    public function dataRamaisSettings(RamalSetting $ramalSetting){
        $data = $ramalSetting::all();
        return $this->anyData($data);
    }
    
    public function dataTroncos(Troncos $troncos){
       $troncosr = new Troncos;
       $attr_avanc_khomp = new attr_avanc_khomp;
       $attr_troncos_ip = new attr_troncos_ip;
       $attrarr = array();

       $resul = $troncosr::all();
       $attrs = $attr_avanc_khomp::all();
       $ip = $attr_troncos_ip::all();

       $troncosarray = $resul->toArray(); //array de troncos
       $attarray = $attrs->toArray(); //array de atributos avancados khomp
       $iparray = $ip->toArray(); //array de atributos avancados ip
       
       foreach($troncosarray as &$tronco){
             foreach ($attarray as $attkhomp){
                if($tronco['id'] == $attkhomp['id']){
                  foreach($attkhomp as $key=>$a){
                     $tronco[(String)$key] = $a;
                  }
                }
             }
             foreach($iparray as $ip){
                 if ($tronco['id'] == $ip['id']){
                     foreach ($ip as $key=>$i){
                     $tronco[(String)$key] = $i;
                     }
                 }
             }
       }

       $output = json_encode(array('data' => ($troncosarray)));
       return $output;
    }

    public function dataJuntor(Juntor $juntores){
        $data = $juntores::all();
        return $this->anyData($data);
    }

    public function dataJuntorMin(Juntor $juntores){
        $data =  DB::table('juntores')->get(); 
        return ($data);
    }
    
}
