<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\RamalSetting;

class RamalSettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(RamalSetting $entity){

        $this->entity = new $entity;
        $this->middleware('auth');

    }

    public function index(){
        $masters = RamalSetting::getMasters();
        $types = RamalSetting::getTypes();
        return view('admin.ramais.settings.index', compact('masters','types'));
    }

    public function create(){
        $masters = RamalSetting::getMasters();
        $types = RamalSetting::getTypes();
        return view('admin.ramais.settings.create', compact('masters','types'));
    }

    public function store(Request $request){

        $status = (boolean) $this->entity->create([
            'parent_id' => (($request->type<1) ? null : $request->type),
            'name' => $request->subtype,
            'class' => $request->class,
            'status' => 1
        ]);

        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Configuração criada com sucesso!');

        return redirect()->route('admin.ramais.settings.index');
    }
    public function edit($id){

        $entity = $this->entity->find($id);

        $masters = RamalSetting::getMasters();
        $types = RamalSetting::getTypes();
//
        return view('admin.ramais.settings.edit', compact('entity', 'masters','types'));
    }

    public function update(Request $request){

        $entity = $this->entity->find($request->id);

        $entity->update([
            'parent_id' => (($request->parent_id<1) ? null : $request->parent_id),
            'name' => $request->name,
            'class' => $request->class,
            'status' => 1
        ]);

        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Dados atualizados com sucesso!');

        return redirect()->route('admin.ramais.settings.index');

    }

    public function destroy(){

        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();
        return response()->json(['status'=>$id]);

    }
    public function getList(){
        $list = RamalSetting::getList();
        return view('admin.ramais_setup.container-list', compact('list'));
    }

    public function getSubtypes(Request $request){
        $subtypes = RamalSetting::getSubtypes($request->parent_id);
        return response()->json(['subtypes'=>$subtypes]);
    }
}
