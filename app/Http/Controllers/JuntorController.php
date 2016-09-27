<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Juntor;
use App\Models\hardwares;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DataTablesController;
use DB;
use View;

class JuntorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*  public function index()
    {0
        return view('tronco.index', ['troncos' => $troncos]);
    } */
    public function __construct(Juntor $entity, Hardwares $entity2) {
        $this->entity = new $entity;
        $this->entity2 = new $entity2;
        $this->middleware('auth');
    }
     
    function getAllHardwares(){
       $tudo = new DataTablesController;
       $all = $tudo->dataHardwares($this->entity2);
       $para_corrigir =  $this->before('}]', $this->after('[{',$all));
       $corrigido = '[{'.$para_corrigir.'}]';
       return json_decode($corrigido);
    }

     function getBoardsKhomp($boardId){
       $tudo = new DataTablesController;
       $all =  DB::table('hardwares')->where('id', $boardId)->get();
     }
   
    public function getPortasUsadasKhomp(){
     $juntores = file('/home/sistema/public/assets/kgroups.txt', FILE_IGNORE_NEW_LINES+FILE_SKIP_EMPTY_LINES);
     $portasusadas = array();

      foreach($juntores as $jt) {
             $needle = (explode('+',$this->after('= ', $jt)));
             $board = trim($this->before('c', $needle[0]));
             
             if(isset($portasusadas[$board])){
                  $portasusadas[$board][] =  $needle[0];
             } else {
                  $portasusadas[$board] = $needle;       

             }

      }
    

      foreach ($portasusadas as &$px) {
            foreach ($px as $key => $p) {
                   $px[$key] = $this->desconverteChannelsKHOMP($p);
            }
       }
       return ($portasusadas);
    }

    function isChannel($item){ //auxilia a getCanaisDahdi() à achar os fxks ou fxoks do arquivo ex.: fxsks =1;
          if(strpos(preg_replace('/\s+/', '', $item), 'fxoks=') !== FALSE ||
             strpos(preg_replace('/\s+/', '', $item), 'fxsks=') !== FALSE
            ){
             return true;
          } 
          return false;             
    }
    
    public function getCanaisDahdi(){ //retorna o vetor com os numeros dos canais Dahdi
        $txt = file('/etc/dahdi/system.conf', FILE_IGNORE_NEW_LINES);
        $canais = array_filter($txt, array($this,'isChannel'));
        
        foreach ($canais as &$c){ //remove a parte "fxsks=" da string dos vetores
              $c = trim($this->after('=', $c));
        }

        return ($canais);
    }

    public function dgvGetCanaisVetor($canais)
    {
      if($canais != 0)
      {
         foreach ($canais as &$c) {
            
            $portas = $c['portas'];
            $c['vetordecanais'] = array();
            $portasVetor = array();

              if( strpos( $portas, ',' ) === false ){
                  $e = $this->before('-', $portas);
                  $d = $this->after('-', $portas);
                  
                  for($i = intval($e) ; $i <= $d ; $i++){
                     array_push($portasVetor, $i);
                  }
                  $c['vetordecanais'] = $portasVetor;

              } else if ( strpos( $portas, ',' ) !== false ){
                  $portas = explode(',', $c['portas']);
                   
                   foreach ($portas as &$p){
                     if( strpos($p , '-') !== false){
                        $e = $this->before('-', $p);
                        $d = $this->after('-', $p);   
                            for($i = intval($e) ; $i <= $d ; $i++){
                               array_push($portasVetor, $i);
                            }
                     } else {
                        array_push($portasVetor, intval($p));  
                     } 
                   }   
                 
                 $c['vetordecanais'] = $portasVetor;

              }
         } 
         return ($canais);
    }
    }

    public function confereLinearidadeKhomp($portas){
         $flag = true; 
         for ( $i = 0 ; $i < count($portas) ; $i++ ){
                if (isset($portas[$i+1]) ) {
                    if( $this->after('c',$portas[$i+1]) != $this->after('c',$portas[$i])+1 ) {
                      $flag = false;
                    } 
                }
         } 
         return($flag);
    }
    
    public function confereLinearidadeVetor($portas){
      $flag = true; 
         for ( $i = 0 ; $i < count($portas) ; $i++ ){
                if ( isset($portas[$i+1]) ) {
                    if( ($portas[$i+1]) != ($portas[$i])+1 ) {
                      $flag = false;
                    } 
                }
         } 
         return($flag);
    }

    public function desconverteChannelsKHOMP($portas){
     if( strpos($portas, '-') != false){
                 $esq = $this->after('c', $this->before('-', $portas));
                 $dir = $this->after('-', $portas);
                 $board = $this->before('c', $portas);
                 $buffer = '';
                 
                 for($i = $esq; $i <= $dir ; $i++){
                    $buffer .= $board.'c'.$i.'+';
                 }      
            return($this->before_last('+', $buffer));       
              }
     return ($portas);
    }

    public function desconverteChannelsDgv($portas){
        $final = array();
        if ( strpos($portas, '-' ) !== false ){
              $e = $this->before('-', $portas);
              $d = $this->after('-', $portas);
              for($i = $e  ; $i <= $d ; $i++){
                   array_push($final, intval($i));
              }
        } else {
              $final = explode(',',$portas);
        }
        $final[0] = intval($final[0]);
        return ($final);
    }
   
    public function converteChannelsKHOMP($linear, $nome, $portas){
                $final = $nome." = ";
                $ehlin = 0;

                 if($linear){
                    $final .= $portas[0]."-".$this->after('c',$portas[count($portas)-1]);
                    $ehlin = 1;
                }  else {
                    foreach($portas as $porta){
                    $final .= $porta.'+';
                    $ehlin = 0;
                    }
                }  
                if($ehlin == 0){$final = $this->before_last('+',$final);
                }          
                return ($final);
    }
    
    public function converteChannelsDgv($portas, $linear){
        $final = '';
        if($linear){
                if (count($portas) > 2){
                   $final = $portas[0].'-'.end($portas);
                   return $final;
                } else
                if (count($portas) == 2){
                   $final = trim($portas[0]).','.trim($portas[1]);
                   return trim($final);
                } 
                else if (count($portas) == 1) {
                $final = $portas[0];
                return intval($final);
                }
                } else {  //criar conversão melhor;      
                    for ( $i = 0 ; $i < count($portas) ; $i++){
                        $final .= $portas[$i].',';
                    }
                return ( $this->before_last(',',$final) );
                } 
    }

    public function montaChannelsDgv($nome, $portas, $linear){
       $final = 'group='.$nome.chr(13).chr(10).'ports=>'.$this->converteChannelsDgv($portas, $linear);
          
          
        return ($final);
    }

    
    public function nomeDisponivelKhomp($nome){
        $arquivo = '/home/sistema/public/assets/kgroups.txt';
        $text = file($arquivo);  
          
          foreach ($text as &$line){
                 if(strpos($line, $nome) !== false && ($this->before(' =', $line) == $nome) )
                 {
                    return(false);
                 }
          }
          return(true);
    }

    public function totalportasdgvparaString($totaldeportasbuffer){
            $totaldeportas = '';
            foreach ($totaldeportasbuffer as &$p)  {
                  $p = implode(',', $p);
            }
            
            if(count($totaldeportasbuffer) > 1){
            for ($i = 0 ; $i < count($totaldeportasbuffer) ; $i++){
                 $totaldeportas .= $totaldeportasbuffer[$i].',';
            }
             
            }

          return ($this->before_last(',',$totaldeportas ));
    }

    public function nomeDisponivelDgv($nome){
      $arquivo = '/etc/asterisk/digivoice_additional.conf';
      $text = file($arquivo, FILE_SKIP_EMPTY_LINES+FILE_IGNORE_NEW_LINES); 
      $flag = true;
        foreach ($text as $key => $line){
            if(strpos($line,'[groups]') !== false){      
                for( $i = $key ; $i<count($text) ; $i++ ){
                    if ( strpos(trim($this->before('=',$text[$i])), 'group') === 0 && strpos( trim($this->before('>', $text[$i+1])) , 'ports=' ) === 0) {
                         if ( strpos( trim( $this->after( '=', $text[$i])),  $nome) !== false ) {
                             $flag = false; 
                         }
                    }
                }  
            }
        }
        
     return($flag);
    }

    public function totalPortasUsadasDgv(){
     $arquivo = '/etc/asterisk/digivoice_additional.conf';
     $txt = file($arquivo, FILE_IGNORE_NEW_LINES+FILE_SKIP_EMPTY_LINES);
     $total = array();
     
     foreach ($txt as $line){
         if( strpos($line, 'ports=>') !== false ){ 
            $buf = $this->desconverteChannelsDgv ($this->after('=>', $line), $this->confereLinearidadeVetor($this->after('=>', $line)) );
            array_push( $total, $buf );
         }
     }
     
     return ($total);
    }
    
    public function getPortasUsadasDahdi(){
        $jun = DB::table('juntores')->select('juntor')->where('fabricante', '=', '16')->get();        
        $usadas = '';
         
         foreach ($jun as $key=>$j){
           $portas = $this->desconverteChannelsDgv($j->juntor);
           $usadas .= ($key > 0 ?',': '').implode(',',$portas);
         }

        return $usadas;
    }

    public function edit($id, $fab){
        $resul =  DB::table('juntores')->where('id','=',$id)->first();
        switch ($fab) {
          case '11':
            $board = DB::table('hardwares')->where('serial','=', $resul->board_serial)->first();
            if($board !== null){
              $usadas = $this->desconverteChannelsKHOMP($resul->juntor);
              $portas = $board->portas;
              $tipo = $board->tipo;
            }
          break;
          case '14':
            $portasusadasbuffer = $this->desconverteChannelsDgv($resul->juntor);
            $usadas = implode(',',$portasusadasbuffer);
            $canaisdgv = $this->dgvGetCanais();
            $canaisdgv = $this->dgvGetCanaisVetor($canaisdgv);
            $portas = $this->totalportasdgvparaString( $this->totalPortasUsadasDgv() );
            $portasf = array_diff ( explode(',',$portas) , $portasusadasbuffer);
            $portas = implode(',',$portasf);
          break;
          case '16':
            $dahdi = array();
            $dahdi['totalPortasUsadas'] = implode(',', array_diff(explode(',',$this->getPortasUsadasDahdi()) , $this->desconverteChannelsDgv($resul->juntor)) );
            $dahdi['totalPortas'] = ($this->getCanaisDahdi() );
            $dahdi['usadasPorEste'] = implode(',',$this->desconverteChannelsDgv($resul->juntor));
          break;
        }
        return view('admin.juntor.edit', compact('resul', 'portas', 'usadas', 'board', 'canaisdgv', 'tipo', 'dahdi'));
    }
    
    // public function totalPortasUsadasDahdi(){
          
    // }

    public function update(Request $request){
            $entity = $this->entity->find($request->id);

            switch ($request->fabricante) {
             case '11':
                     $linear = $this->confereLinearidadeKhomp($request->portas);
                     $final = $this->converteChannelsKHOMP($linear, $request->nome, $request->portas);
            
                     $entity->update([
                          'nome' => $request->nome,
                          'juntor' => $this->after('= ',$final),
                          'fabricante' => $request->fabricante,
                     ]); 
             break;            
             case '14':
                    $linear = $this->confereLinearidadeVetor($request->portas);
                     
                    $entity->update([
                      'nome' => $request->nome,
                      'juntor' => $this->converteChannelsDgv($request->portas, $linear),
                      'fabricante' => $request->fabricante,
                    ]);  
             break;
             case '16':
             $linear = $this->confereLinearidadeVetor($request->portas);
             $entity->update([
                      'nome' => $request->nome,
                      'juntor' => $this->converteChannelsDgv($request->portas, $linear),
                      'fabricante' => $request->fabricante,
                    ]);  
             break;

            }
            
            $this->atualizaArquivo();
            Session::flash('message_type', 'success');
            Session::flash('message_text', 'Dados atualizados com sucesso!');
            return redirect()->route('admin.juntor.listar');    
    }   
    
    public function resetaArquivos(){
        $handle = fopen('/home/sistema/public/assets/kgroups.txt','w');
        $handle2 = fopen('/etc/asterisk/digivoice_additional.conf', 'w'); 
        $handle3 = fopen('/etc/asterisk/dahdi-channels.conf', 'w'); 

        fwrite($handle, '');
        fwrite($handle2, '');
        fwrite($handle3, '');

        fclose($handle);
        fclose($handle2);
        fclose($handle3);

    }

    public function atualizaArquivo(){
        $juntores = DB::table('juntores')->get();
        $this->resetaArquivos();

        foreach ($juntores as $j)
        {
                switch ($j->fabricante)
                {
                    case 11 :
                        $final = $j->nome.' = '. $j->juntor;
                        $handle = fopen('/home/sistema/public/assets/kgroups.txt','a');
                        fwrite($handle, chr(13).chr(10).$final.chr(13).chr(10));
                        fclose($handle);
                    break;
                    case 14 :
                         $handle = fopen('/etc/asterisk/digivoice_additional.conf', 'a');
                         $final = 'group='.$j->nome.chr(13).chr(10).'ports=>'.$j->juntor;
                         fwrite($handle, chr(13).chr(10).$final.chr(13).chr(10));
                         fclose($handle);      
                    break;
                    case 16 :
                         $handle = fopen('/etc/asterisk/dahdi-channels.conf', 'a');
                         $final = chr(13).chr(10).'signalling=fxs_ks'.chr(13).chr(10).
                         'callerid=asreceived'.chr(13).chr(10).
                         'group='.$j->nome.chr(13).chr(10).
                         'context=sertel-fxo'.chr(13).chr(10).
                         'channel =>'. $j->juntor.chr(13).chr(10).chr(13).chr(10);
                         fwrite($handle, $final);
                         fclose($handle);
                    break;
                }
        }
    }
    
    public function listar(){
      
       $arquivo = "/home/sistema/public/assets/hardwares";
       $final = array('khomp' => null,
                      'dahdi' => null,
                      'dgv' => null
                      );
           
        $handle = fopen($arquivo, 'r');                            
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
          
        $portasusadas = $this->getPortasUsadasKhomp();
        $boards = $this->getAllHardwares();
        $boards = isset($boards[0]->id) ? $boards : 0; 

        $canaisdgv = $this->dgvGetCanais();
        $canaisdgv = isset($canaisdgv[0]['nome']) ? $this->dgvGetCanaisVetor($canaisdgv) : 0;
        
        $totalportasusadas = $this->totalPortasUsadasDgv();
        $totalportasdgv = $this->totalportasdgvparaString( $this->totalPortasUsadasDgv() );
        
        $totalCanaisDahdi = $this->getCanaisDahdi();
        
        $finalPortasDgv = array();
        
        foreach ($totalportasusadas as $t) {
             array_push($finalPortasDgv, implode(',', $t));
        }

        $totalportasdgv = implode(',',$finalPortasDgv);

        $portasUsadasDahdi = $this->getPortasUsadasDahdi();

      return view('admin.juntor.listar', compact('juntores','final', 'boards', 'portasusadas', 'canaisdgv', 'totalportasdgv', 'totalCanaisDahdi', 'portasUsadasDahdi') );    
    }

    public function store(Request $request){
            $juntor = new Juntor;
            switch ($request->fabricante){
              case '11' :  //khomp               
                      $linear = $this->confereLinearidadeKhomp($request->portas);
                      $final = $this->converteChannelsKHOMP($linear, $request->nome, $request->portas);             
                      $njuntor = $juntor->create([
                      'nome' => $request->nome,
                      'juntor' => $this->after('= ',$final),
                      'fabricante' => $request->fabricante,
                      'board_serial' => $this->before('-', $request->selectFab)
                      ]); 
              break;             
              case '14' : 
                       $linear = $this->confereLinearidadeVetor($request->portas);
                       $final = $this->montaChannelsDgv($request->nome,$request->portas, $linear);

                      $njuntor = $juntor->create([
                      'nome' => $request->nome,
                      'juntor' => $this->after('ports=>', $final),
                      'fabricante' => $request->fabricante,
                      'board_serial' => $this->before('-', $request->selectFab)
                      ]); 
              break;
              case '16' :
                     $linear = $this->confereLinearidadeVetor($request->portas);                 
                     $njuntor = $juntor->create([
                      'nome' => $request->nome,
                      'juntor' => $this->converteChannelsDgv($request->portas, $linear),
                      'fabricante' => $request->fabricante,
                      'board_serial' => null
                      ]);
                     break;
            }
            
            $this->atualizaArquivo();
            return redirect()->route('admin.juntor.listar');
    }


    public function destroy($nome, $fab){
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
        $juntor = $this->entity->find($id);
        $portas = null;

        //Se for dgv
        //Este procedimento vai retornar as portas
        //para que no SWAL, ele possa retirar as portas do
        //sessionStorage, e assim atualizar corretamente
        // as portas marcadas neste juntor.
        if($juntor->fabricante == '14'){
           $portas = $this->desconverteChannelsDgv($juntor->juntor);
           $portas = implode(',', $portas);
        }
        
        $status = $juntor->delete();
        $this->atualizaArquivo();
        return response()->json(['status'=>$id, 'portas'=>$portas]);
    }
    


    /*public function excluiDgv($nome){
         $arquivo = '/etc/asterisk/digivoice_additional.conf';
         $text = file($arquivo); 
         foreach ($text as $key => $line){
            if(strpos($line,'[groups]') !== false){      
                for( $i = $key ; $i<count($text) ; $i++ ){
                    if ( strpos(trim($this->before('=',$text[$i])), 'group') === 0 && strpos( trim($this->before('>', $text[$i+1])) , 'ports=' ) === 0) {
                         if ( strpos( trim( $this->after( '=', $text[$i])),  $nome) !== false ) {
                               $text[$i] = '';
                               $text[$i+1]= '';
                               file_put_contents($arquivo, $text);
                         }
                    }
                }  
            }
        }
    } */
   
  /*  public function getBoardsKhomp(){
     $devicesyaml = "/home/sistema/public/assets/arquivoteste.txt";  
     $lines = file($devicesyaml);
     $countl = count($lines);
     $boardsfinal = array();
     $board = array();
    
     for ($i = 0; $i < $countl; $i++){
          $needle = $this->before('"', ($this->after('"',$lines[$i])));
          if(is_numeric($needle) && strlen($needle) > 1){
                  if(strpos($lines[$i+1], 'Type')){
                     $board['serial'] = trim($needle);
                     $board['portas'] = trim($this->after_last('_', $lines[$i+1])/10);
                     $board['tipo'] = trim($this->before('_', $this->after('-', $lines[$i+1] )));
                    array_push($boardsfinal, $board);
                 }
          }         
      }
     return ($boardsfinal);
    }
   
*/
    public function dgvGetCanais(){
        $arquivo = '/etc/asterisk/digivoice.conf';

        $text = file($arquivo, FILE_SKIP_EMPTY_LINES+FILE_IGNORE_NEW_LINES); 
        $final = array();
        //pegando nome e porta
        foreach ($text as $key => $line){
            if(strpos($line,'[groups]') !== false){      
                for( $i = $key ; $i<count($text) ; $i++ ){
                 //   return(dd(strpos(trim($this->before('>',$text[$i+2])), 'ports=')));
                    if ( strpos(trim($this->before('=',$text[$i])), 'group') === 0 && strpos( trim($this->before('>', $text[$i+1])) , 'ports=' ) === 0) {
                         $canal = array('nome'=>$this->after('=',$text[$i]), 'portas'=>$this->after('=>',$text[$i+1]) );
                         array_push($final, $canal);
                    }
                }  
            }
        }
        //juntando com a sinalização
        $text = file($arquivo, FILE_SKIP_EMPTY_LINES | FILE_IGNORE_NEW_LINES);
        $text = array_slice($text, array_search('port-config', $text));

         foreach($text as $key =>  $line){
             $port = '';
             $sig = '';
             if( strpos($line, 'signalling') !== false ){
                  $sig = $this->after('=', $line);
                    for($i = $key ; $i < count($text) ; $i++){
                       if( strpos($text[$i],'ports=>') !== false ){
                           $port = $this->after('=>', $text[$i]);
                              foreach ($final as &$f){
                                  if($f['portas'] == $port){
                                  $f['sig'] = $sig;
                                  }
                              }
                        }
                  
                    } 
            }
         };

        return($final);
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
    

