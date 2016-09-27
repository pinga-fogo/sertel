<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Codigos;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\PrefixosController;
use App\Http\Controllers\DatatablesController;

class codigoController extends Controller 
{
   
   function __construct(){
           $this->entity = new Codigos;
   } 

   public function index(){
       return view('admin.codigo.index');
   }

   public function getCodigos(){
       $codigos = $this->entity->all();
       return  $codigos;  
   }

   public function store(Request $request){
       
       $this->entity->create([
          'nome'=> $request->nome,
          'senha'=> $request->senha,
          'codigo' => $request->cod_conta,
          'bloqueios'=> implode(',', $request->bloqueios)
       ]);

       return redirect()->route('admin.codigos.index');
   }


   public function destroy(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();    
        return response()->json(['status'=>$id]); 
   }

   public function update(Request $request){
        
        $this->entity->where('id', '=', $request->id)->update([
          'nome'=> $request->nome,
          'senha'=> $request->senha,
          'bloqueios'=> implode(',', $request->bloqueios)
        ]);

        return redirect()->route('admin.codigos.index');

   }
   
}
