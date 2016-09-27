<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Custos;
use App\Models\Ramal;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\PrefixosController;
use App\Http\Controllers\DatatablesController;

class custosController extends Controller 
{
   
   function __construct(){
           $this->entity = new Custos;
   } 

   public function index(){
       $ramal = new Ramal;
       $todos_ramais = $ramal->all();
       return view('admin.custos.index', compact('todos_ramais'));
   }

   public function store(Request $request){
       $custo = new Custos;
       $ramalClass = new Ramal;

       $custo = $this->entity->create([
          'nome'=> $request->nome,
          'recarga_mensal'=> isset($request->recarga_mensal) ? 1 : 0,
          'credito_inicial'=> $this->after('R$ ',$request->cred_valor),
          'credito_atual' => $this->after('R$ ',$request->cred_valor)
       ]);

       $ramais = $request->ramais;
      
       foreach ($ramais as $ramal_id){
             $ramalClass->where('id', '=', $ramal_id)->update([
              'centro_de_custo_id'=>$custo->id
              ]);
       }

       return redirect()->route('admin.custos.index');
   }


   public function destroy(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();    
        return response()->json(['status'=>$id]); 
   }

   public function update(Request $request){
        $ramalClass = new Ramal;
        $custo = new Custos;
        $ramaisAntigos = explode(',', $request->ramaisAntigos);
        $ramais = isset($request->ramais) ? $request->ramais : [];
        
        $ramais_off = array_diff($ramaisAntigos, $ramais);
        


        $this->entity->where('id', '=', $request->id)->update([
          'nome'=> $request->nome,
          'recarga_mensal'=>  $request->recarga_mensal,
          'credito_inicial'=> $this->after('R$ ',$request->cred_valor),
          'credito_atual' => $this->after('R$ ',$request->cred_valor)
        ]);

        foreach ($ramais as $ramal_id){
                $ramalClass->where('id', '=', $ramal_id)->update([
                  'centro_de_custo_id'=>$request->id
                  ]);
        }

        foreach ($ramais_off as $ramal){
                $ramalClass->where('id', '=', $ramal)->update([
                  'centro_de_custo_id'=>null
                  ]);
        }
        
        
        return redirect()->route('admin.custos.index');

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
   
}
