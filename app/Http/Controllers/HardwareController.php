<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hardwares;
use App\Models\Juntor;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DatatablesController;
use App\Http\Controllers\JuntorController;
use DB;
use View;

class HardwareController extends Controller
{
   public function __construct(Hardwares $entity){
        $j = new Juntor;
        $this->jController = new JuntorController($j, $entity);
        
        $this->entity = new $entity;
        $this->middleware('auth');
   }

   public function create(){
         return view('admin.troncos.create');
   }

   public function firstListHardwares(){ 
     //   $arquivo = "/home/sistema/public/assets/hardwares.txt";
        $final = array('khomp' => null,
                       'dahdi' => null,
                       'dgv' => null
                      );

        $handle = fopen('/home/sistema/public/assets/hardwares', 'r');                
        $device = fgets($handle, 1024);
        $devicesSep = explode(';', $device);
   
        foreach ($devicesSep as $devSep){
                  switch($devSep){
                    case 'khomp': {$final['khomp'] = 1; break; }
                    case 'dgv':   {$final['dgv'] = 1; break; }
                    case 'dahdi': {$final['dahdi'] = 1; break; }
                  }
  
        }
       fclose($handle);
       return view('admin.hardware.index', compact('final'));
   }
   
   public function index(){
     //$resul = DB::table('troncos')->get();
     return view('admin.hardware.index');
   }

   public function edit($id){      
      $hardware = $this->entity->find($id);
      
      //se for um E1
      //transforma a string de perfis em
      //um array  
      if($hardware->tipo == 'E1'){
           if(strpos($hardware->perfis, ';') !== FALSE){
                $hardware->perfis = explode(';', $hardware->perfis);
           }
      }
      
      $final = array('serial'=> $hardware->serial, 
                     'tipo'=>$hardware->tipo, 
                     'ip'=>$hardware->ip, 
                     'portas'=> $hardware->portas,
                     'perfil'=> $hardware->perfis
                     );
      
      #$ip = $this->getIp($final['serial']);      
      
      $this->atualizaArquivo();
      return view('admin.hardware.edit', compact('final'));   
   }

   
   public function update(Request $request){
            //os E1 terão a variável $perfisLinks
            //que guarda perfis de vários Links
            //já os GSM, FXS ou FXO terão somente a $perfil
            
            if(isset($request->perfisLinks)){
                $perfil = implode(';', $request->perfisLinks);
            } 

            if(isset($request->perfil)){
                $perfil = $request->perfil;
            }
              
            if(isset($request->ip)){
                $ip = $request->ip;
            }

            //o serial será usado como chave primária
            if(isset($request->serial_buffer) && $request->serial_buffer != ''){
                $serial = $request->serial_buffer;
            }
            
            $hardware = $this->entity->where('serial', '=', $serial);
            
            $res = $hardware->update([
                "perfis" => $perfil,
                "ip" => $ip,
            ]);
            
            if($res){
              Session::flash('message_type', 'success');
              Session::flash('message_text', 'Hardware atualizado com sucesso');
            } else {
              Session::flash('message_type', 'warning');
              Session::flash('message_text', 'Um erro inesperado ocorreu');
            }


            return redirect()->route('admin.hardware.list');
   }       
     
   public function updatePosicoes(){
         if (isset($_GET['newpos']))
         {
              foreach ($_GET['newpos'] as $key=>$p) 
              {
                $board = (DB::table('hardwares')->where('serial', '=', $p['serial']));
                      if ($board !== null)
                      {
                         $re = $board->update([
                            'board' => $key
                         ]);    
                      }          
              }
              $this->updateBoardJuntores();
              $this->atualizaArquivo();
         }
   }
     
   public function destroy(Request $request){                   
        $id = isset($_GET['id']) ? $_GET['id'] : 0;  
       
        $thisSerial = DB::table('hardwares')->where('id', '=', $id)->value('serial');
        
        DB::table('juntores')->where('board_serial', '=', $thisSerial)->delete();
        $this->entity->find($id) != null ? $status = $this->entity->find($id)->delete() : '';

        $this->updateBoardJuntores();
        $this->atualizaArquivo();
        return response()->json(['status'=>$id]);
   } 

   public function after($chave, $inthat) {
     if (!is_bool(strpos($inthat, $chave)))
        return substr($inthat, strpos($inthat,$chave)+strlen($chave));
   }

   public function getIp($serial){
     $devicesyaml = "/etc/khomp/config/devices.yaml";  
     $lines = file($devicesyaml);
     $countl = count($lines);
     for ($i = 0; $i < $countl; $i++){
          if(strripos($lines[$i], $serial)){
                 for($j = $i; $j < ($i+4); $j++){
                   if(strripos($lines[$j], 'IP:') != false && strlen($lines[$j])>3){
                       return ($this->after('IP: ', $lines[$j]));
                       fclose($handle);
                   }
                 }   
          }         
      }
   }
 
   public function isCadastrado($serial){
        $h = $this->entity->where('serial', '=', $serial)->first(); 
        if($h != null){
          return 1;
        }
        return 0;
   }
    
   public function detectdgv(){ 
          #$arquivo = '/etc/asterisk/digivoice.conf';
          $arquivoDigiAdd = '/etc/asterisk/digivoice_additional.conf';
  
          $handle = fopen ($arquivoDigiAdd,'r');
          
          if(file_exists($arquivoDigiAdd)){
              $text = file_get_contents($arquivoDigiAdd); 
              //return(dd($text));  
          } 
         
          return view('admin.hardware.configdgv', compact('text', 'txtDigiAdd'));
   }
      
   public function configdahdi($count = 0){ 
          $arquivoSystem_conf = '/etc/dahdi/system.conf';
          $arquivoChannel_conf = '/etc/asterisk/dahdi-channels.conf';
          $count++;

          if(file_exists($arquivoSystem_conf) && file_exists($arquivoChannel_conf)){
              $system_conf = file_get_contents($arquivoSystem_conf);
              $channels_conf = file_get_contents($arquivoChannel_conf);
          } else {
             $output= array();
             $r = exec('dahdi_genconf 2>&1', $output);
             if (strpos($r, 'Empty') !== false){
               $msg = "Ocorreu uma falha na leitura.  Erro: ".$r.'';
               
                if($count >= 3){
                   //Lançar uma excessão aqui.
                   //Para não ocorrer loop infinito
                   exit;
                }

               $this->configdahdi($count);
               $err = 1;
             }
          }

          return view('admin.hardware.configdahdi'  ,  compact('msg', 'err', 'system_conf', 'channels_conf')); 
   }
      
   public function savedahdi (Request $request){
        $arquivoSystem_conf = '/etc/dahdi/system.conf';
        $arquivoChannel_conf = '/etc/asterisk/dahdi-channels.conf';
        
        file_put_contents($arquivoSystem_conf,$request->system_conf);
        file_put_contents($arquivoChannel_conf,$request->channels_conf);
  
        #return view('admin.hardware.configdahdi', compact('msg', 'system_conf', 'channel_conf'));

        Session::flash('message_type', 'success');
        Session::flash('message_text', 'Arquivo salvo com sucesso');

        return redirect()->route('admin.hardware.detectdahdi');
   }

   public function savedgv(Request $request){ 
          $arquivo = '/etc/asterisk/digivoice_additional.conf';
          
          if( file_exists($arquivo) ){
                file_put_contents($arquivo, $request->dgvfile); 
          } 
          
          return redirect()->route('admin.hardware.detectdgv');
   }


   public function detectkhomp(){               
        $resul = '';
        $stringbuffer = '';
        $final = array();
        $handle = fopen('/etc/khomp/devices','r');
        if ($handle) {
            while (($buffer = fgets($handle, 1024)) !== false) {
                 $resul = $buffer;
                 $result = explode(' ',$resul, 7);
                 $result = array(
                           'ts'=>date("d/m/Y G:i:s", $result[0]),
                           'serial'=>$result[1],
                           'hardware' => $result[2],//$this->after('-', $this->before('_', $result[2])),
                           'numero'=>$result[3],
                           'portas'=>($this->after_last('_', $result[2])/10),
                           'portas2'=>$result[5],
                           'numero2'=>$result[6],
                           'tipo' => $this->before('_', $this->after('-', $result[2])),
                           'ip' => ($this->getIp($result[1])>1 ? $this->getIp($result[1]) : null),
                      
                           );
                 
                 if(!$this->isCadastrado($result['serial'])){
                  array_push($final, $result);
                 }
            } 
            fclose($handle);
            return view('admin.hardware.detect', compact('final', 'stringbuffer'));     
        } 
   }

   public function listar(){               
           $hardwares = $this->getAll();
           $e1 = array();
           if(isset($hardwares[0]->id)){
               foreach($hardwares as $key=>$h){
                  if ($h->tipo=='E1'){
                     $novoe1['hardware'] = $h;
                     $novoe1['perfis'] = explode(';',$h->perfis);
                     array_push($e1, $novoe1);
                     unset($hardwares[$key]);
                  }
               }
           } else {
              unset($hardwares);
              unset($e1);
           }

           return view('admin.hardware.list', compact('hardwares', 'e1'));
   }

   // public function listarDahdi(){
   //   $arquivoSystem = '/etc/dahdi/system.conf';
   //   $linhas = file($arquivoSystem, FILE_IGNORE_NEW_LINES);

   //   foreach($linhas as $linha){
   //       //Se a linha não estiver comentada
   //       if(substr($linha, 0, 1) !== ';'){

   //       }
   //   }


   // } 
           
   function updateBoardJuntores(){
         $juntoresKhomp = DB::table('juntores')->where('fabricante','=', 11)->get();

         foreach ($juntoresKhomp as $jun){
           $boardAtual = DB::table('hardwares')->where('serial','=', $jun->board_serial)->value('board');
           $boardVector = explode('c', $jun->juntor);
           $boardVector[0] = 'b'.$boardAtual;
           $boardString = implode('c', $boardVector);
           DB::table('juntores')->where('id', '=', $jun->id)->update([
            'juntor' => $boardString
            ]); 
         }
        $this->jController->atualizaArquivo(); 
   }

   function write(Request $request){
            $version = '';

            
            if(isset($request->hardware)){
                if(strpos($request->hardware, "V1") !== FALSE)
                   $version = "V1";
                else if(strpos($request->hardware, "V2") !== FALSE){
                        $version = "V2"; 

                }
                else if(strpos($request->hardware, "V3") !== FALSE)
                   $version = "V3";
            } 
            

            //o próximo hardware vai ter a board igual a (maior índice das boards atuais + 1)
            $maior_board_atual = (DB::table('hardwares')->orderBy('board', 'desc')->value('board')); 

            $boardNum = $maior_board_atual != null ? ($maior_board_atual)+1 : 0;

            if(isset($request->perfisLinks)) {
                $perfis = implode(';', $request->perfisLinks);
            }

            $hardware = $this->entity->create([
                'serial' => isset($request->serial) ? $request->serial : '',
                'ip' => isset($request->ip) ? $request->ip : '',
                'tipo' => isset($request->tipo) ? $request->tipo : '',
                'portas' => isset($request->portas) ? $request->portas : '',
                'perfis' => isset($perfis) ? $perfis : '',
                'version' => $version,
                'board' => $boardNum,
                'hardware' => isset($request->hardware) ? $request->hardware : ''
            ]);

            $this->atualizaArquivo();
            $this->updateBoardJuntores();
            return redirect()->route('admin.hardware.list');
   }

   function getAll(){
       $tudo = new DataTablesController;
       $all = $tudo->dataHardwares($this->entity);
       $para_corrigir =  $this->before('}]', $this->after('[{',$all));
       $corrigido = '[{'.$para_corrigir.'}]';
       return json_decode($corrigido);
   }

   function resetaArquivo(){
          $handle = fopen("/home/sistema/public/assets/arquivoteste.txt", "w");
          fwrite($handle, '');
          fclose($handle);
   }

   function atualizaArquivo(){
       $this->resetaArquivo();
       $devicesyaml = "/etc/khomp/config/devices.yaml"; 
       
       $hardwares = $this->getAll();
       $count = count($hardwares[0]);
       #dd($hardwares[0]->id);
         if(isset($hardwares[0]->id)) #este if verifica a função retornou algum elemento
            file_put_contents($devicesyaml, '---'.chr(13).chr(10).'"Devices":');
             $handle = fopen($devicesyaml, 'a');

            foreach ($hardwares as $h){
               if($h->tipo == 'E1' ){
                           $portas = $h->portas;
                           $qtdLinks = ($portas/300);
                           $perfisVetor = explode(';',$h->perfis);

                           $links = '';
                           //$bufferperfis = explode('x', $request->strbufferperfil);   
                          
                           for($i = 0; $i < $qtdLinks; $i++){
                                $links .= chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'-'.chr(13).chr(10).
                                                chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'"'.$i.'":'.chr(13).chr(10).
                                                chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'Type: E1'.chr(13).chr(10).
                                                chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'"Name": '.chr(13).chr(10).
                                                chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'Profile: '.$perfisVetor[$i].chr(13).chr(10); 
                           }
                          
                           if($h->version !== '' && ($posicao = strpos($h->hardware, trim($h->version))) !== FALSE) {
                                  $excesso = substr($h->hardware, $posicao-1, 3);
                                  $h->hardware = implode('' ,explode($excesso, $h->hardware)); 
                           }

                           fwrite($handle, 
                                    chr(13).chr(10).
                                    chr(32).chr(32).'-'.chr(13).chr(10).
                                    chr(32).chr(32).chr(32).chr(32).chr(34).$h->serial.chr(34).':'.chr(13).chr(10).
                                    chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'Type: '.$h->hardware.chr(13).chr(10).
                                    chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'IP:'.chr(32).$h->ip.chr(13).chr(10).
                                    chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'CustomTonesProfiles:'.chr(32).'Profile1'.chr(13).chr(10).
                                    chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'"LinkOperationMode": E1'.chr(13).chr(10).
                                    chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'"Replacer": '.chr(13).chr(10).
                                    chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'Version: '.$h->version.' '.chr(13).chr(10).
                                    chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'"Links": '.chr(13).chr(10).
                                    $links.
                                    chr(13).chr(10)
                               );

              } else if ( $h->tipo == 'FXS' || $h->tipo == 'FXO' ||  $h->tipo == 'GSM')
                      {
                             
                      fwrite($handle, ''.chr(13).chr(10).
                                      chr(32).chr(32).'-'.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(34).$h->serial.chr(34).':'.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'Type: '.$h->hardware.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'IP:'.chr(32).$h->ip.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'CustomTonesProfiles:'.chr(32).'Profile1'.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'"Replacer": '.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'Version:'.chr(32).$h->version.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'"ChannelGroups": '.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'-'.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'"0-'.($h->portas-1).' ": '.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'Type:'.chr(32).$h->tipo.chr(13).chr(10).
                                      chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'Profile:'.chr(32).$h->tipo.chr(13).chr(10)
                       );
                    }
          }
                fclose($handle);
          
   }
   
   function before($esse, $inthat)
   {
        return substr($inthat, 0, strpos($inthat, $esse));
   }
  
   function para_array($texto) {
      $resultado = array();
    
      $partes = explode(",", $texto); // quebra em assinalamentos
      foreach ($partes as $parte) {
          list($chave, $valor) = explode("=", $parte); // separa chave e valor
          $resultado[$chave] = $valor;
      }
      return $resultado;
   }

   function after_last ($esse, $inthat)
   {
        if (!is_bool($this->strrevpos($inthat, $esse)))
        return substr($inthat, $this->strrevpos($inthat, $esse)+strlen($esse));
   }
    
   function strrevpos($instr, $needle)
   {
         $rev_pos = strpos (strrev($instr), strrev($needle));
         if ($rev_pos===false) return false;
         else return strlen($instr) - $rev_pos - strlen($needle);
   }

     // public function getLinks($serial){
  //    $devicesyaml = "/home/sistema/public/assets/arquivoteste.txt";  
  //    $lines = file($devicesyaml);
  //    $countl = count($lines);
  //    $linkbody = array();
  //    for ($i = 0; $i < $countl; $i++){
  //         if(strripos($lines[$i], $serial)){
  //                for($j = $i+8; $j < $i+26 && $j<=$countl; $j+=5){
  //                      if(is_numeric($this->before('"',  $this->after('"', $lines[$j])))){
  //                         $bodybuffer = array('link' => $lines[$j],
  //                                      'tipo' => $lines[$j+1],
  //                                      'nome' => $lines[$j+2],
  //                                      'perfil' => $this->after('Profile: ', $lines[$j+3]) ,
  //                         );
  //                         array_push($linkbody, $bodybuffer);
  //                      } else { 
  //                       break;
  //                      } 
  //                }     
  //       }  

  //    }   return ($linkbody);          
  // } 


   /* public function getPortas($serial){
     $devicesyaml = "/home/sistema/public/assets/arquivoteste.txt";  
     $lines = file($devicesyaml);
     $countl = count($lines);
     for ($i = 0; $i < $countl; $i++){
          if(strripos($lines[$i], $serial)){
                 if(strpos($lines[$i+1], 'Type')){
                  return ($this->after_last('_', $lines[$i+1])/10);
                 }
          }         
      }
    }

    public function getPerfil($serial){
     $devicesyaml = "/home/sistema/public/assets/arquivoteste.txt";  
     $lines = file($devicesyaml);
     $countl = count($lines);
     for ($i = 0; $i < $countl; $i++){
          if(strripos($lines[$i], $serial)){
                 for($j = $i; $j < ($i+10); $j++){
                   if(strripos($lines[$j], 'Profile: ') != false && strlen($lines[$j])>3){
                       return ($this->after('Profile: ', $lines[$j]));
                       fclose($handle);
                   }
                 }   
          }         
      }
    }*/


      /* public function addip($serial, Request $request){               
      //$devicesyaml = "/etc/sistema/public/assets/arquivoteste.txt";

      $handle = fopen($devicesyaml, "r");
      $lines = file($devicesyaml);
      $flag = 0;
      $countl = count($lines);
      //return($request->ip);
      for ($i = 0; $i < $countl; $i++){
          if(strripos($lines[$i], $serial))
           {        
            $flag = 1;
                 for($j = $i; $j < $countl; $j++){
                   if(strripos($lines[$j], 'IP') != false){
                       fclose($handle);
                       $handle = fopen($devicesyaml, 'w');
                       $lines[$j] = chr(32).chr(32).chr(32).chr(32).chr(32).chr(32).'IP:'.chr(32).$request->ip.chr(13).chr(10);
                        file_put_contents($devicesyaml, $lines);
                       fclose($handle);
                       break;
                   }
                 }
             } 
      }
     return ($this->detectkhomp());
    }*/


     // public function editSPX($id){
      
    //   $hardware = $this->entity->find($id);

    //   $final['tipo'] = $hardware->tipo;
    //   $final['portas'] = $hardware->portas;
    //   $final['ip'] = $hardware->ip;
    //   $final['serial'] = $hardware->serial;

      
    //  # $final['portas'] = $this->getPortas($final['serial']);
    //   return view('admin.hardware.edit', compact('final'));
    // }

} 
   

  