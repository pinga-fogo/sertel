<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Voice_mail;
use App\Http\Controllers\DatatablesController as dadosVoice;
use DB;

class voiceMailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
         $this->entity = new Voice_mail;
         $this->middleware('auth');
    }

    public function index(){
        return view('admin.voice_mail.index');
        //return view('admin.groups.list');
    }

    public function store(Request $request){

        $voice_mail = $this->entity->create([
            'nome'               => $request->nome,
            'remetente'          => $request->de,
            'destino'            => isset($request->para) ? $request->para : '', 
            'ramal'              => $request->ramal,  
            'senha'              => $request->senha,
            'habilitado'         => $request->habilitado !== null ? 1 : 0,
            'mensagem'           => $request->mensagem,
        ]);

        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Voice Mail criado com sucesso!');
        $this->atualizaArquivo();

        return redirect()->route('admin.voice_mail.index');
    }

     public function update(Request $request, $id){

        $voice_mail = $this->entity->find($id)->update([
            'nome'               => $request->nome,
            'remetente'          => $request->de,
            'destino'            => isset($request->para) ? $request->para : '', 
            'ramal'              => $request->ramal,   
            'habilitado'         => $request->habilitado,
            'senha'              => $request->senha,
            'mensagem'           => $request->mensagem,
        ]);
        
        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Voice Mail editado com sucesso!');
        $this->atualizaArquivo();

        return redirect()->route('admin.voice_mail.index');
     }
   

    public function destroy(){

        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $status = $this->entity->find($id)->delete();
        $this->atualizaArquivo();

        return response()->json(['status'=>$id]);
    }


    public function atualizaArquivo(){
         $voice_mail = new Voice_mail;
         $arquivo = "/etc/asterisk/correio_voz2.conf";
         $string = '[correio_de_voz]'.chr(13).chr(10).chr(13).chr(10);

         $data = DB::table('voice_mail')
                      ->join('ramais', 'voice_mail.ramal','=', 'ramais.id')    
                      ->select(DB::raw("voice_mail.*,ramais.nome as nome_ramal, ramais.id as id_ramal, ramais.numero as numero_ramal"))->orderBy('voice_mail.created_at')->get();
        

          foreach($data as $voice){
                // 250 => 250,Eduardo,eduardof.microlins@gmail.com,,|tz=brazil|attach=yes|saycid=yes|dialout=fromvm|callback=fromvm|review=yes|operator=yes|envelope=yes|moveheard=yes|sayduration=yes|saydurationm=1
            
            $string .= $voice->numero_ramal.'=>'.$voice->senha.','.$voice->remetente.','.$voice->destino.',,'.'|tz=brazil|attach=yes|saycid=yes|dialout=fromvm|callback=fromvm|review=yes|operator=yes|envelope=yes|moveheard=yes|sayduration=yes|saydurationm=1'.chr(13).chr(10);
          }

                  
          file_put_contents($arquivo, $string);

    }
}
