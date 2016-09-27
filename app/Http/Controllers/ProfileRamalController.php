<?php

namespace App\Http\Controllers;

use App\Models\RamalSetting;
use Illuminate\Http\Request;

use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\RamalController;
use App\Models\ProfileRamal;
use App\Models\Ramal;


class ProfileRamalController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ProfileRamal $entity){

        $this->entity = new $entity;
        $this->middleware('auth');

    }

    public function index(){
        return view('admin.ramais.profiles.index');
    }
    
    public function getDependencias($id){
         $dependentes = DB::table('ramais')->where('profile_ramal_id','=', $id);
         if( $dependentes != null){
             return ($dependentes);
         } else {
             return 0;
         }
    }

    public function store(Request $request){
    

    $user = $this->entity->create([
            'nome' => $_GET['nome'],
            'envia_mcdu' => isset($_GET['mcdu_send']) ? '1' : '0' ,
            'aceita_a_cobrar' => isset($_GET['collect_call']) ? '1' : '0' ,
            'grupo_captura' => $_GET['group_capture'],
            'captura_grupos' => $_GET['capture_groups'],
            'acesso_interno' => isset($_GET['internal_access'])  ? '1' : '0' ,
            'acesso_local' => isset($_GET['local_access'])  ? '1' : '0' ,
            'acesso_fixo_ddd' => isset($_GET['fixed_access_ddd'])  ? '1' : '0' ,
            'acesso_movel_local' => isset($_GET['access_mobile_local'])  ? '1' : '0' ,
            'acesso_movel_ddd' => isset($_GET['ddd_mobile_access'])  ? '1' : '0' ,
            'acesso_especial' => isset($_GET['special_access']) ? '1' : '0' ,
            'numeros_servico' => isset($_GET['access_number_services'])  ? '1' : '0' ,
            'rota_especial' => isset($_GET['especial_access_rota'])  ? '1' : '0' ,
            'agenda' => isset($_GET['agenda']) ? '1' : '0' ,
            'cadeado' => isset($_GET['padlock'])  ? '1' : '0' ,
            'conferencia' => isset($_GET['conference'])  ? '1' : '0' ,
            'consulta_saldo' => isset($_GET['query_sale']) ? '1' : '0' ,
            'siga_me' => isset($_GET['enable_follow_me'])  ? '1' : '0' ,
            'ultimo_no_externo_recebido' => isset($_GET['last_external_number_received'])  ? '1' : '0' ,
            'ultimo_no_interno_recebido' => isset($_GET['last_received_number_internal'])  ? '1' : '0' ,
            'voice_mail' => isset($_GET['access_to_voice_mail'])  ? '1' : '0' ,
            'fala_ramal' => isset($_GET['ramal_talks']) ? '1' : '0' ,
            'informacoes_servidor' => isset($_GET['server_information'])  ? '1' : '0' , 
            'acesso_fila' => isset($_GET['login_queue']) ? '1' : '0' ,   
    ]);

        
        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Perfil criado com sucesso!');

    return redirect()->route('admin.ramais.profiles.index');
    }


    public function teste(){
        $ramal = new Ramal;
        $profiles_em_ramais = $ramal->lists('profile_ramal_id');
        $todos_profiles = $this->entity->all();
        foreach ($profiles_em_ramais as $p){
             foreach ($todos_profiles as $t){
                if ($p == $t->id){
                     $t['dependencia'] = 1;
                } else {
                     $t['dependencia'] = 0;
                }
             }
        }
    }

    /*public function edit($id){
        $entity = $this->entity->find($id);
        $masters = RamalSetting::getMasters();
        $types = RamalSetting::getTypes();
        return view('admin.ramais.profiles.edit', compact('entity', 'masters','types'));
    }*/

    public function update($id){
        $entity = $this->entity->find($id);
        
        $entity->update([
            'nome' => $_GET['nome'],
            'envia_mcdu' => isset($_GET['mcdu_send']) ? '1' : '0' ,
            'aceita_a_cobrar' => isset($_GET['collect_call']) ? '1' : '0' ,
            'grupo_captura' => $_GET['group_capture'],
            'captura_grupos' => $_GET['capture_groups'],
            'acesso_interno' => isset($_GET['internal_access'])  ? '1' : '0' ,
            'acesso_local' => isset($_GET['local_access'])  ? '1' : '0' ,
            'acesso_fixo_ddd' => isset($_GET['fixed_access_ddd'])  ? '1' : '0' ,
            'acesso_movel_local' => isset($_GET['access_mobile_local'])  ? '1' : '0' ,
            'acesso_movel_ddd' => isset($_GET['ddd_mobile_access'])  ? '1' : '0' ,
            'acesso_especial' => isset($_GET['special_access']) ? '1' : '0' ,
            'numeros_servico' => isset($_GET['access_number_services'])  ? '1' : '0' ,
            'rota_especial' => isset($_GET['especial_access_rota'])  ? '1' : '0' ,
            'agenda' => isset($_GET['agenda']) ? '1' : '0' ,
            'cadeado' => isset($_GET['padlock'])  ? '1' : '0' ,
            'conferencia' => isset($_GET['conference'])  ? '1' : '0' ,
            'consulta_saldo' => isset($_GET['query_sale']) ? '1' : '0' ,
            'siga_me' => isset($_GET['enable_follow_me'])  ? '1' : '0' ,
            'ultimo_no_externo_recebido' => isset($_GET['last_external_number_received'])  ? '1' : '0' ,
            'ultimo_no_interno_recebido' => isset($_GET['last_received_number_internal'])  ? '1' : '0' ,
            'voice_mail' => isset($_GET['access_to_voice_mail'])  ? '1' : '0' ,
            'fala_ramal' => isset($_GET['ramal_talks']) ? '1' : '0' ,
            'informacoes_servidor' => isset($_GET['server_information'])  ? '1' : '0' , 
            'acesso_fila' => isset($_GET['login_queue']) ? '1' : '0' ,   
        ]);
        
        $ramal = new Ramal;
        $rController = new RamalController($ramal, $this->entity);
        $rController->atualizaArquivo();
        
        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Perfil atualizado com sucesso!');

        return redirect()->route('admin.ramais.profiles.index');
    }
    
    public function verificaDependencia(){
        $dependentes = $this->getDependencias();
        if ($dependentes != 0){
            return 1;
        } else {
            return 0;
        }
    }

    public function destroy(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();
         
        return response()->json(['status'=>$id]);
    }

    public function setDefault(Request $request){
        $this->entity->update(['default' => 0]);
        $entity = $this->entity->find($request->id);
        $entity->update(['default'=>1]);
        return response()->json(['status'=>true]);

        /*$this->entity->update(['default' => 0]);
        $entity = $this->entity->find($request->id);
        $entity->update(['default'=>1]);
        return response()->json(['status'=>true]);*/
    }

    public function verifyDefault(Request $request){
    }
}
