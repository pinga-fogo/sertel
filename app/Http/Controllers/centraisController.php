<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Centrais;
use App\Models\Troncos;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class centraisController extends Controller 
{
   
   function __construct(){
           $this->entity = new Centrais;
   } 

   public function index(){
           $troncos = Troncos::all();
           
           return view('admin.centrais.index', compact('troncos'));
   }
   

   public function store(Request $request){

      $this->entity->create([
          'nome' => $request->nome,
          'codigo' => $request->codigo,
          'tipo'   => $request->tipo,
          'tronco' =>$request->tronco
      ]);

       Session::flash('message_type', 'success');
       Session::flash('message_text', 'Central cadastrada com sucesso');

       return redirect()->route('admin.centrais.index');

   }


   public function update(Request $request){
        $this->entity->find($request->id)->update([
            'nome' => $request->nome,
            'codigo' => $request->codigo,
            'tipo'   => $request->tipo,
            'tronco' =>$request->tronco
        	]);

       Session::flash('message_type', 'success');
       Session::flash('message_text', 'Central atualizada com sucesso');

       return redirect()->route('admin.centrais.index'); 
   }
   
   public function destroy(Request $request){
        $id = isset($request->id) ? $request->id : 0;
        $status = $this->entity->find($id)->delete(); 
        return response()->json(['status'=>$id]);  
   }
}
