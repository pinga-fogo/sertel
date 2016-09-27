<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Codigos;
use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class testing extends Controller 
{
   
   function __construct(){
           $this->entity = new Codigos;
   } 

   public function index(){
       return view('admin.codigo.index');
   }

   public function calcTarifaFixo(){
      $final = 0;
      $saldoAtual = '150,00';
      $saldoCorrigido = str_replace(',', '.', $saldoAtual);

      //supondo o cálculo com 30/6
      $metodo['bloco_inicial'] = 30;
      $metodo['tamanho_blocos'] = 6;

      $tarifa = '0,04';
      $tarifaCorrigida = str_replace(',', '.', $tarifa);
      echo 'tarifaCorrigida: '.$tarifaCorrigida.'<br>';

      
      
      $segundos = 225037;
      echo 'Segundos: '.$segundos.'<br>';

      //nos primeiros 30 segundos cobra 50% da tafica por minuto;
      $final += $tarifaCorrigida/2;

      //tira os primeiros 30 segundos para o cálculo;
      $segundosReal = $segundos > 30 ? $segundos - ($metodo['bloco_inicial']) : $segundos;

      //número de blocos dividido por 10% da tarifa por minuto;
      $numero_blocos = (int)($segundosReal/6);
      echo 'Número de blocos: '.$numero_blocos.'<br>';

      $sobra = $segundosReal % 6; 
      echo 'Sobra: '.$sobra.'<br>';

      $preco_por_bloco = $tarifaCorrigida/10;
      echo 'Preço por bloco: '.$preco_por_bloco.'<br>';
      
      $final += ($numero_blocos) * ($preco_por_bloco) + ($sobra > 0 ? $preco_por_bloco : 0 );
      

      //calcular tempo maximo de ligação

      if($saldoAtual < ($tarifa/2)){
         $tempo_maximo = 0;

      } else if($saldoAtual == ($tarifa/2)){
         $tempo_maximo = 30;
      } else {
         $saldoUtil = $saldoAtual - ($tarifa/2);
         $tempo_maximo = (($saldoUtil/$preco_por_bloco) * 6)+30;
      } 


      

      // -----

      echo 'A pagar:'.number_format($final, 2);
      echo '<br>--------------------<br>';
      echo 'Tempo máximo de ligação: '.$tempo_maximo.' Segundos. <br>';

   }


   public function calcTarifaCelular(){

    $tarifa = '0,04';
    $tarifaCorrigida = str_replace(',', '.', $tarifa);
    $segundos= '';

   }
   
}
