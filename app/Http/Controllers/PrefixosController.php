<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\BlackListController;
use App\Models\Troncos;
use App\Models\Destinos;
use App\Models\BlackList;



class PrefixosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(){
        /*$this->entity = new $entity;
        $this->middleware('auth');*/
    } 

    
    public function index(Request $request) 
    {
        $tab = isset($request->tab) ?  $request->tab : 'fixo'; /*** Tab vem do adicionar ou remover tronco ***/ 

        $troncos = $this->getTroncos();
        $troncosAdicionados = array();
        
        $troncosAdicionados['especiais'] = $this->getTroncosAdicionados('num_especiais');
        $troncosAdicionados['servicos'] = $this->getTroncosAdicionados('num_servicos');
        $troncosAdicionados['ddi'] = $this->getTroncosAdicionados('ddi');
        $troncosAdicionados['movel_local'] = $this->getTroncosAdicionados('movel_local');
        $troncosAdicionados['movel_ddd'] = $this->getTroncosAdicionados('movel_ddd');
        $troncosAdicionados['fixo_local'] = $this->getTroncosAdicionados('fixo_local');
        $troncosAdicionados['fixo_ddd'] = $this->getTroncosAdicionados('fixo_ddd');
        
        $entity = new BlackListController;
        $numBlackList = $entity->index();

        return view('admin.prefixos.index', compact('troncos', 'troncosAdicionados', 'tab') );
    } 
    
   public function getTroncos($id = 0){
        $tronco = new Troncos;
        $dataController = new DatatablesController;
        if ($id === 0){ //pega todos os troncos
        
        $tronco = json_decode($dataController->dataTroncos($tronco));
        return $tronco->data;
        
        } else { //pega só um tronco pelo id
        
        $troncoNome = $tronco->where('id', '=', $id)->value('nome');
        return $troncoNome;
        
        }

   }
  
   public function getTroncosAdicionados($tipo){
        $destino = new Destinos;
        $resul = $destino->where('destino','=',$tipo)->value('troncos');
        
        if($resul  == ''){
            return null;
        }
        
        $troncosAdicionados = $resul;

        $arrayTroncos = explode(',',$troncosAdicionados);
        
        foreach ($arrayTroncos as $key=>$t){
            $array = array();
            $array['nome'] = $this->getTroncos($t);
            $array['id'] = $t;

            $arrayTroncos[$key] = $array;
        }
        
        return $arrayTroncos;
   }

   public function save(Request $request, $tipo){

       switch($tipo){
    
        case 'ddi':
        $entity = new Destinos;
            $troncos = is_array($request->troncos) ? implode(',',$request->troncos) : $request->troncos;
            
            $re = $entity->where('destino', '=', 'ddi')->update([
                'troncos' => $troncos
                ]);
        break;

        case 'movel_local':
        $entity = new Destinos;
            $troncos = is_array($request->troncos) ? implode(',',$request->troncos) : $request->troncos;
            
            $re = $entity->where('destino', '=', 'movel_local')->update([
                'troncos' => $troncos
                ]);
        break;

        case 'movel_ddd':
        $entity = new Destinos;
            $troncos = is_array($request->troncos) ? implode(',',$request->troncos) : $request->troncos;
            
            $re = $entity->where('destino', '=', 'movel_ddd')->update([
                'troncos' => $troncos
                ]);
        break;

        case 'fixo_ddd':
        $entity = new Destinos;
            $troncos = is_array($request->troncos) ? implode(',',$request->troncos) : $request->troncos;
 
            $re = $entity->where('destino', '=', 'fixo_ddd')->update([
                'troncos' => $troncos
                ]);
        break;
        
        case 'fixo_local':
        $entity = new Destinos;
            $troncos = is_array($request->troncos) ? implode(',',$request->troncos) : $request->troncos;

            $re = $entity->where('destino', '=', 'fixo_local')->update([
                'troncos' => $troncos
                ]);
        break;


        case 'servicos':
        $entity = new Destinos;
            $troncos = is_array($request->troncos) ? implode(',',$request->troncos) : $request->troncos;
            $re = $entity->where('destino', '=', 'num_servicos')->update([
                'troncos' => $troncos
                ]);
        break;

        case 'especiais':
        $entity = new Destinos;
            $troncos = is_array($request->troncos) ? implode(',',$request->troncos) : $request->troncos;
            
            $re = $entity->where('destino', '=', 'num_especiais')->update([
                'troncos' => $troncos
                ]);
        break;
       }

       return 1;
   }
   
   public function adicionarTronco(Request $request){
     $id = $request->id;
     $tipo  = $request->tipo;
     $tab = ''; //variável que indicará qual tab será exibida após o refresh
     
     switch($tipo){
        
        case 'especiais':
        $entity = new Destinos;
        $re = $entity->where('destino', '=', 'num_especiais')->first();
        $atual = $re->troncos;
        $entity->where('destino', '=', 'num_especiais')->update([
                'troncos' => $atual != '' ? $atual.','. $id :  $id 
                ]);
        
        $tab = 'especiais';
        break;

        case 'servicos':
        $entity = new Destinos;
        $re = $entity->where('destino', '=', 'num_servicos')->first();
        $atual = $re->troncos;
        $a = $entity->where('destino', '=', 'num_servicos')->update([
                'troncos' => $atual != '' ? $atual.','. $id :  $id 
                ]);
        
        $tab = 'servicos';
        break;


        case 'ddi':
        $entity = new Destinos;
        $re = $entity->where('destino', '=', 'ddi')->first();
        $atual = $re->troncos;
        $a = $entity->where('destino', '=', 'ddi')->update([
                'troncos' => $atual != '' ? $atual.','. $id :  $id 
                ]);
        
        $tab = 'ddi';
        break;

        case 'movel_local':
        $entity = new Destinos;
        $re = $entity->where('destino', '=', 'movel_local')->first();
        $atual = $re->troncos;
        $a = $entity->where('destino', '=', 'movel_local')->update([
                'troncos' => $atual != '' ? $atual.','. $id :  $id 
                ]);
        
        $tab = 'movel';
        break;

        case 'movel_ddd':
        $entity = new Destinos;
        $re = $entity->where('destino', '=', 'movel_ddd')->first();
        $atual = $re->troncos;
        $a = $entity->where('destino', '=', 'movel_ddd')->update([
                'troncos' => $atual != '' ? $atual.','. $id :  $id 
                ]);
        
        $tab = 'movel';
        break;
        
        case 'fixo_local':
        $entity = new Destinos;
        $re = $entity->where('destino', '=', 'fixo_local')->first();
        $atual = $re->troncos;
        $a = $entity->where('destino', '=', 'fixo_local')->update([
                'troncos' => $atual != '' ? $atual.','. $id :  $id 
                ]);
        
        $tab = 'fixo';
        break;

        case 'fixo_ddd':
        $entity = new Destinos;
        $re = $entity->where('destino', '=', 'fixo_ddd')->first();
        $atual = $re->troncos;
        $a = $entity->where('destino', '=', 'fixo_ddd')->update([
                'troncos' => $atual != '' ? $atual.','. $id :  $id 
                ]);
        
        $tab = 'fixo';
        break;
       }
       
       return redirect()->route('admin.prefixos.index', $tab);
}
    
    public function removerTroncoDeTodos($id){
        $entity = new Destinos;
        $tipos = ['num_especiais','num_servicos', 'movel_local', 'movel_ddd', 'fixo_local', 'fixo_ddd', 'ddi'];

        foreach($tipos as $t){
              $atual = explode(',',$entity->where('destino', '=', $t)->value('troncos') );
              if($atual != null){
                  if(array_search($id, $atual) !== FALSE){
                      unset($atual[array_search($id, $atual)]);
                      $atual = implode(',',$atual);
                      $entity->where('destino','=',$t)->update(['troncos'=>$atual]);
              }
        
              }
               
        }

    }

    public function removerTronco(Request $request){ 
        $id = $request->id;
        $tipo = $request->tipo;
        $tab = '';
        $entity = new Destinos; 
        $entity2 = new Troncos;
       
        switch($tipo){
           case 'especiais':
             $troncoDestino = $entity->where('destino','=','num_especiais');
             $tronco['nome'] = $entity2->where('id', '=' , $id)->value('nome');
             $atual = explode(',', $troncoDestino->value('troncos'));
             unset($atual[array_search($id, $atual)]);
             $novo = implode(',', $atual);
             $tab = 'especiais';
             $troncoDestino->update(['troncos' => $novo]);
           break; 

           case 'servicos':
             $troncoDestino = $entity->where('destino','=','num_servicos');
             $tronco['nome'] = $entity2->where('id', '=' , $id)->value('nome');
             $atual = explode(',', $troncoDestino->value('troncos'));
             unset($atual[array_search($id, $atual)]);
             $novo = implode(',', $atual);
             $tab = 'servicos';
             $troncoDestino->update(['troncos' => $novo]);
           break; 

           case 'ddi':
             $troncoDestino = $entity->where('destino','=','ddi');
             $tronco['nome'] = $entity2->where('id', '=' , $id)->value('nome');
             $atual = explode(',', $troncoDestino->value('troncos'));
             unset($atual[array_search($id, $atual)]);
             $novo = implode(',', $atual);
             $tab = 'ddi';
             $troncoDestino->update(['troncos' => $novo]);
           break; 


           case 'movel_local':
             $troncoDestino = $entity->where('destino','=','movel_local');
             $tronco['nome'] = $entity2->where('id', '=' , $id)->value('nome');
             $atual = explode(',', $troncoDestino->value('troncos'));
             unset($atual[array_search($id, $atual)]);
             $novo = implode(',', $atual);
             $tab = 'movel';
             $troncoDestino->update(['troncos' => $novo]);
           break; 

           case 'movel_ddd':
             $troncoDestino = $entity->where('destino','=','movel_ddd');
             $tronco['nome'] = $entity2->where('id', '=' , $id)->value('nome');
             $atual = explode(',', $troncoDestino->value('troncos'));
             unset($atual[array_search($id, $atual)]);
             $novo = implode(',', $atual);
             $tab = 'movel';
             $troncoDestino->update(['troncos' => $novo]);
           break; 

           case 'fixo_local':
             $troncoDestino = $entity->where('destino','=','fixo_local');
             $tronco['nome'] = $entity2->where('id', '=' , $id)->value('nome');
             $atual = explode(',', $troncoDestino->value('troncos'));
             unset($atual[array_search($id, $atual)]);
             $novo = implode(',', $atual);
             $tab = 'fixo';
             $troncoDestino->update(['troncos' => $novo]);
           break; 

            case 'fixo_ddd':
             $troncoDestino = $entity->where('destino','=','fixo_ddd');
             $tronco['nome'] = $entity2->where('id', '=' , $id)->value('nome');
             $atual = explode(',', $troncoDestino->value('troncos'));
             unset($atual[array_search($id, $atual)]);
             $novo = implode(',', $atual);
             $tab = 'fixo';
             $troncoDestino->update(['troncos' => $novo]);
           break;
        }
        
         return redirect()->route('admin.prefixos.index', $tab);
    }
   
}








