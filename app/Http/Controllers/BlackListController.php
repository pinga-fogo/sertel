<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Troncos;
use App\Models\BlackList;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Http\Controllers\PrefixosController;
use App\Http\Controllers\DatatablesController;

class BlackListController extends Controller 
{
   
   function __construct(){
           $this->entity = new BlackList;
   } 

   public function index(){
           $troncos = $this->getTroncos();
           return view('admin.blacklist.index', compact('troncos'));
   }
   
   public function setNum(Request $request){
          $res = $this->entity->create([
               'numero'=>$request->numero,
               'tronco'=> implode(',',$request->troncos),
               'tipo_bloqueio'=>$request->tipo_bloqueio
          ]);

          return redirect()->route('admin.black_list.index');
   }

   public function getTroncos(){
   	    $tronco = new Troncos;
        $dataController = new DatatablesController;
        $tronco = json_decode($dataController->dataTroncos($tronco));
        return count($tronco->data) > 0 ? $tronco->data : 0;
   }

   public function update(Request $request){
        $this->entity->find($request->id)->update([
            'numero' => $request->numero,
            'tipo_bloqueio' => $request->tipo_bloqueio,
            'tronco' => implode(',',$request->troncos),     
        	]);

       return redirect()->route('admin.black_list.index'); 
   }
   
   public function destroy(Request $request){
        $id = isset($request->id) ? $request->id : 0;
        $status = $this->entity->find($id)->delete();    
        return response()->json(['status'=>$id]);  
   }
}
