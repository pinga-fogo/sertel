<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Validator;
use Illuminate\Support\Facades\Input;
use Redirect;
use App\Models\Audios;


class audiosController extends Controller 
{
   
   function __construct(){
           $this->entity = new Audios;
   } 

   public function index(){
    
       return view('admin.audios.index');
   }

   public function store(Request $request){
       
   }


   public function destroy(){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        $audio = $this->entity->find($id);
        
        shell_exec('rm /var/lib/asterisk/sounds/pt_BR/'.$audio->nome.'.*');
        shell_exec('rm /var/lib/asterisk/sounds/pt_BR/para_web/'.$audio->nome.'.*');

        $status = $audio->delete();    
        return response()->json(['status'=>$id]); 
   }

    public function upload(Request $request){
         // pegando dados do POST;
         $file = array('audio' => Input::file('audio'));
         $nome = $request->nome_audio;

         // colocando as regras
         $rules = array('audio' => 'mimes:wav,WAV,mp3,wma,audio/mpeg,mpga'); //mimes:jpeg,bmp,png e para tamanho máximo:10000
        
         // fazendo a validação, passando data do POST, regras e as mensagens
         $validator = Validator::make($file, $rules);
         if ($validator->fails()) {

          // manda de volta com os dados do input e dos erros
            Session::flash('message_type', 'warning');
            Session::flash('message_text', $validator->errors()->first());
          return back();
          //->withInput()->withErrors($validator);
         }
         else {
          // checa se o arquivo é válido
          if (Input::file('audio')->isValid()) {
            
            $destinationPath = '/var/lib/asterisk/sounds/pt_BR/para_web';
            
            if(!is_dir($destinationPath)){
                  mkdir($destinationPath);
            }

            //caminho do upload
            $extension = Input::file('audio')->getClientOriginalExtension(); // pegando extensão do áudio

            $fileName = $nome.'.'.$extension; // renomeando áudio
            Input::file('audio')->move($destinationPath, $fileName); // movendo o arquivo para o caminho especificado
            
            $caminho = $destinationPath.'/'.$fileName;

            $shell_result = '';

            //converte o arquivo para .WAV e manda para a pasta certa do Asterisk
            if($extension == 'mp3'){
              //converte para .wav
                $shell_result .= shell_exec('mpg123 -w /tmp/'.$nome.'.wav '.$caminho);
                //$shell_result .= shell_exec('mpg123 -w /var/lib/asterisk/sounds/pt_BR/para_web/'.$nome.'.wav '.$caminho);
                $shell_result .= shell_exec('cp /tmp/'.$nome.' '.$caminho); 
              //transforma em 8000KHz  
                $shell_result .= shell_exec('sox /tmp/'.$nome.'.wav -r 8000 -c 1 /var/lib/asterisk/sounds/pt_BR/'.$nome.'.wav');
                $shell_result .= shell_exec('ln -s /tmp/'.$nome.'.wav '.public_path().'/assets/audios');

            } else {
                $shell_result .= shell_exec('rasterisk -x "file convert '.$caminho.' /var/lib/asterisk/sounds/pt_BR/'.$nome.'.WAV" ');
                $shell_result .= shell_exec('rasterisk -x "file convert '.$caminho.' /var/lib/asterisk/sounds/pt_BR/para_web/'.$nome.'.wav"');

                 $shell_result .= shell_exec('ln -s /var/lib/asterisk/sounds/pt_BR/para_web/'.$nome.'.wav '.public_path().'/assets/audios/');
            }

            //cria o link simbólico para o arquivo.

            //dd($shell_result);
            //escreveu o shell result no log !!
            
            $this->entity->create([
              'nome'=> $nome,
              'caminho'=> '/var/lib/asterisk/sounds/pt_BR/'.$nome.'.WAV',
            ]);

            Session::flash('message_type', 'success');
            Session::flash('message_text', 'Arquivo adicionado com sucesso');
            return back();
          }
          else {
            // sending back with error message.
            Session::flash('message_type', 'warning');
            Session::flash('message_text', 'Este arquivo não é válido');
            return back();
          }
        }
    }

         
    }
