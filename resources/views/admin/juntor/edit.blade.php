@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Editar Juntor
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-list"></i>  <a href="{{route('admin.juntor.listar')}}">Listagem</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Editar Juntor
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<center>

<div class="row">
        @include('admin.showerros')
        {!! Form::model($resul, array('route' => array('admin.juntor.update', $resul->id), 'method'=>'put', 'id'=>'formEdit')) !!}

             <div id='divNome' class="form-group">
                    {{ Form::label('nome', 'Nome') }}
                    {{ Form::text('nome', null, ['placeholder'=>'Digite o nome do Juntor', 'class'=>'form-control', 'aria-describedby'=>'divErrorNome']) }}
                    <span class='help-block' id='divErrorNome'></span>
             </div>  
             <input type='text' id="nome_antigo" class="board hidden" name="nome_antigo" value='' class='buffer' />
</div>
                <div class="form-group">
                   <div id="channels">
                      <br>
                     
                         <div id="" class="portas b{{--$j--}}">  
                         @if (isset($board))
                             @if ($board->tipo == 'E1') <span class='hidden'> {{ $f = 0 }}    </span>
                                 @for ($i = 0 ; $i < $board->portas/30 ; $i++)       
                                  <fieldset class='scheduler-border'><legend class='scheduler-border'>@if($board->tipo =='E1') Link : {{ $i }} @endif </legend>
                                       @for ($y = $f ; $y < ($i+1) * 30 ; $y++) 
                                        <label class="labelp" for="{{'b'.$board->board.'c'.$y}} "> <input type="checkbox" id="{{'b'.$board->board.'c'.$y}}" value="{{'b'.$board->board.'c'.$y}}" class="porta" name='portas[]'/> {{$y}}</label>
                                       @endfor
                                       <span class='hidden'>
                                       {!!
                                        $f = $y 
                                       !!};
                                       </span> 
                                 </fieldset>
                                @endfor
                           @endif
                           @if ($board->tipo == 'FXO' || $board->tipo == 'FXS'  ||$board->tipo=='GSM') <span class='hidden'> {{ $f = 0 }}    </span>
                           
                                <!-- @for ($i = 0 ; $i < $board->portas/30 ; $i++) -->
                                     
                                  <fieldset class='scheduler-border'><legend class='scheduler-border'>{{$board->tipo}}</legend>
                                       @for ($i = 0 ; $i < $board->portas; $i++) 
                                        <label class="labelp" for="{{'b'.$board->board.'c'.$i}} "> <input type="checkbox" id="{{'b'.$board->board.'c'.$i}}" value="{{'b'.$board->board.'c'.$i}}" class="porta" name='portas[]' /> {{$i}}</label>
                                       @endfor
                                       <span class='hidden'>
                                      
                                       </span> 
                                
                                 </fieldset>
                               <!--  @endfor -->
                           @endif
                       
                             <input type='button' id="selectAll" class='btn bControl' value='marcar todos'/>
                             <input type='button' id="deSelectAll" class='btn bControl' value='desmarcar todos'/>
                            <!-- <input type='button' id="voltar" class='btn bControl' value='Voltar'/><br> -->
                           
                              <input type='text' id="stringbufferkhomp" class="board hidden" value='{{ $usadas }}' />  
                         @endif
                         

                         @if (!isset($board))
                           @if (isset($canaisdgv))                          
                               @foreach ($canaisdgv as $cdgv)
                                    <div id="{{$cdgv['nome']}}" class="portasDgv">     
                                    <fieldset class='scheduler-border'>
                                      <legend class='scheduler-border'> 
                                        {{ 
                                          isset($cdgv['sig']) ?
                                           $cdgv['sig'] == 'r2mfc_ndis_fixed' ? 
                                           'R2 - Ndis_Fixo' :  ($cdgv['sig'] == 'r2mfc_ndis_variable' ?
                                           'R2 - Ndis_Variável' : ($cdgv['sig'] == 'gsm' ?
                                           'GSM' : ($cdgv['sig'] == 'fxo' ?
                                           'FXO' : ($cdgv['sig'] == 'fxs' ?
                                           'FXS' : 'signalling_nao_identificado')))) : '' 
                                        }} 
                                      </legend>
                                    @foreach ($cdgv['vetordecanais'] as $c)
                                        <label class="labelp" for=""> 
                                            <input type="checkbox" id="" value='{{$c}}' class="{{$cdgv['nome']}} portadgv"  name='portas[]'/>
                                            {{ $c }}
                                        </label>
                                    @endforeach
                                   <br>
                                   </div>
                              @endforeach
                              <fieldset> 
                                <input type='text' id="stringbufferdgv" class="board hidden " value='{{ $usadas }}' class='buffer' /> 
                                <input type='text' id="totalusadas" class="board hidden" value='{{ $portas }}' class='buffer' /> 
                           @endif
                           @if(isset($dahdi))
                            
                                    <div id="" class="portasDahdi"><fieldset class='scheduler-border'><legend class='scheduler-border'> FXO  </legend>
                                    @foreach ($dahdi['totalPortas'] as $c)
                                        <label class="labelp" for=""> <input type="checkbox" id="" value='{{$c}}' class="portadahdi"  name='portas[]'/>{{ $c }}</label>
                                    @endforeach
                                   <br>
                                   </div> 
                         

                         <input type='text' value='{{$dahdi['usadasPorEste']}}' id='usadasPorEste' class='hidden'>
                         <input type='text' value='{{$dahdi['totalPortasUsadas']}}' id='totalUsadas' class='hidden'>
 
                           @endif
                         @endif

                    </div> 
                    <!--{{ Form::label('juntor', 'Juntor') }}
                    {{ Form::text('juntor', null, ['placeholder'=>'Digite o Juntor', 'class'=>'form-control']) }} -->
                    </div>
                    <div class="form-group">
                    {{ Form::text('id', null, ['placeholder'=>'Digite o Juntor', 'class'=>'hidden']) }}
                    </div>
                    <div class="form-group fab form-notip gsm_khomp_fab"> 
                    {{ Form::label('fabricante', 'Fabricante', ['class'=>'fab']) }} 
                    {{ Form::select('fabricante',
                     [
                     0 => '‹‹ selecione ››',
                     11 => 'KHOMP',
                     16 => 'Dahdi',
                     14 => 'Digivoice'
                     ]
                    , null, ['class'=>'form-control', 'data-default'=>'','required']) }} 
                    </div>  

                        </center>

                    <div class="form-group">
                        <button type="button" id='saveEdit'class="btn btn-primary btn pull-left">Salvar</button>
                    
                    </div>
                    <div class='form-group' style='float:left'>
                        <button type="button" id='cancelBtn' class="btn btn-default btn pull-left">Cancelar</button>
                    </div>
     

        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@endsection

@push('scripts')
<script src='/assets/js/controleJuntor.js'></script>
<script>       
       $(function(){
             
             $('#nome_antigo').val( $('#nome').val() );
             
             $('.fab').hide();
             $('#cancelBtn').on('click', function(){
                history.back();
             });      
             
             $('#saveEdit').on('click', function(){
                    if (valida()){
                      $('#formEdit').submit();
                    }
             });
            
             switch ($('#fabricante').val())
             {
              case '11': 
                  val = $('#stringbufferkhomp').val();
                  val = val.split('+');
                  $('.porta').each(function(){
                  if(val.indexOf( $(this).val())  != -1){
                        $(this).attr('checked', 'checked');
                  } else { 
                       $(this).attr('checked', false)
                  }
                });
              break;

              case '14':    
                   var vetorPortas = $('#stringbufferdgv').val().split(',');
                   var usadas = $('#totalusadas').val().split(',');
                     $('.portadgv').each(function()
                       {            
                       if( vetorPortas.indexOf($(this).val() )  != -1){
                           $(this).attr('checked', 'checked');
                       } 
                       else if ( usadas.indexOf( $(this).val() )!= -1)
                       {
                           $(this).attr('disabled', 'disabled');
                           console.log($('#totalusadas').val());
                       }                       
                       else 
                       { 
                           $(this).attr('checked', false);
                       }              
                     });                                   
              break;
              
              case '16':
                   var usadas = $('#usadasPorEste').val().trim().split(',');
                   var totalUsadas = $('#totalUsadas').val().trim().split(',');
                   console.log('usadas: '+usadas);
                   $('.portadahdi').each(function(){
                      if( usadas.indexOf( $(this).val().trim() ) != -1 ){
                        $(this).attr('checked', 'checked');
                      }      
                      else if (totalUsadas.indexOf( $(this).val().trim() ) != -1){
                        $(this).attr('checked', 'checked');
                        $(this).attr('disabled', 'disabled');
                      } else {
                        $(this).removeAttr('checked');
                      }
                   });
              break;
             } 

            

            $('#selectAll').on('click',function(){ 
                console.log('Marcou todos');
                $('.porta:visible').each(function (){
                      this.checked = true;
                });         
            });

            $('#voltar').on('click', function(){
              $('.porta').each(function(){
               if( $('#stringbuffer').val().indexOf($(this).val())  != -1){
                    console.log($(this).val());
                    $(this).attr('checked', 'checked');
              } else { $(this).attr('checked', false)}
             });
            });

            
            $('#deSelectAll').on('click',function(){ 
                console.log('Desmarcou todos');
                $('.porta').each(function (){
                      this.checked = false;
                });
           });
       });
</script>
@endpush