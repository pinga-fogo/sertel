<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tarifas;
use DB;
use View;

class tarifasController extends Controller
{
    function __construct (){
        $this->entity = new Tarifas;
    }
    public function index(){
        $tarifas = $this->getTarifas();
        return view('admin.tarifas.index', compact('tarifas'));
    }

    public function getTarifas(){ 
        $tarifas = $this->entity->all()->groupBy('operadora');    
        return $tarifas;
    }

    public function save(Request $request){
    
      $operadoras = $this->entity->select('operadora')->get();
      $campo = array();
      
      foreach ($operadoras as $ope){
           $campo['movel']  =  $request{$ope->operadora.'_movel'};
           $campo['fixo'] =  $request{$ope->operadora.'_fixo'};
           
           if(strpos($campo['fixo'],'R$') === FALSE){
               $this->entity->where('operadora','=',$ope->operadora)->update([
                'tarifa_fixo'=>$campo['fixo']
                ]);
           } else {
              $this->entity->where('operadora','=',$ope->operadora)->update([
                'tarifa_fixo'=> trim($this->after('R$', $campo['fixo']))
                ]);
           }

           if(strpos($campo['movel'], 'R$') === FALSE){
               $this->entity->where('operadora','=',$ope->operadora)->update([
                'tarifa_movel'=>$campo['movel']
                ]);
           } else {
              $this->entity->where('operadora','=',$ope->operadora)->update([
                'tarifa_movel'=>trim($this->after('R$', $campo['movel']))
                ]);
           }
           
      }
      
      return redirect()->route('admin.tarifas.index');
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



