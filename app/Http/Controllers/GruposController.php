<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Grupos;

class GruposController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
         $this->entity = new Grupos;
         $this->middleware('auth');
    }

    public function index(){
        return view('admin.grupos.index');
        // return view('admin.groups.list');
    }

    public function store(Request $request){
        
        $ramais = implode(',', $request->ramais);


        $grupo = $this->entity->create([
            'tipo'            => $request->tipo,
            'ramais'          => $ramais,
            'numero'          => $request->numero,
            'rota_dir'        => $request->rota_dir,
            'correio_de_voz'  => $request->correio_de_voz == null ? 0 : 1,
            'tempo_chamada'   => $request->tempo_chamada,
            'email'           => $request->email
        ]);
        

        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Grupo criado com sucesso!');

        return redirect()->route('admin.grupos.index');
    }

     public function update(Request $request, $id){
        $ramais = isset($request->ramais) ? implode(',', $request->ramais) : '';

        $grupo = $this->entity->find($id)->update([
            'tipo'            => $request->tipo,
            'ramais'          => $ramais,
            'numero'          => $request->numero,
            'rota_dir'        => $request->rota_dir,
            'correio_de_voz'  => $request->correio_de_voz == null ? 0 : 1,
            'tempo_chamada'   => $request->tempo_chamada,
            'email'           => $request->email
        ]);
        

        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Grupo editado com sucesso!');

        return redirect()->route('admin.grupos.index');
    }
   

    public function destroy(){

        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();
        return response()->json(['status'=>$id]);

    }
}
