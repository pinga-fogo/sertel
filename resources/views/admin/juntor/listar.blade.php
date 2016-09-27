@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Juntores
            
        </h1>
        <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i>  <a href="{{route('admin.troncos.index')}}">Troncos</a> / Juntores
                </li>
            </ol>
    </div>
</div>
    <a href="#" data-target='#myModal' data-toggle='modal' class="btn btn-block btn-info"><span class="glyphicon glyphicon-plus"></span> Criar Juntor</a><br>

<!-- /.row -->
<!-- Page Heading -->
<div class="row">
        <div class="display">
             @include('admin.juntor..juntorDataTable')
        </div>
</div>
<!-- /.row -->

<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalDefaultTitle"></h4>
      </div>
      <div class="modal-body" id="modalDefaultBody">
        <center>
        {!! Form::open(array('route' => 'admin.juntor.store', 'method'=>'post', 'id'=>'formJuntor')) !!}            
                {!! csrf_field() !!}

                <div class="form-group ">
                    {{ Form::label('nome', 'Nome') }}
                    {{ Form::text('nome', null, ['placeholder'=>'Digite o nome do Juntor', 'class'=>'form-control', 'required'=>'required', 'maxlength'=>'20']) }}
                </div>  
                <input type='text' id="nome_antigo" class="board hidden" name="nome_antigo" value='' class='.buffer' />
                <!--<div class="form-group">
                    {{ Form::label('juntor', 'Juntor') }}
                    {{ Form::text('juntor', null, ['placeholder'=>'Digite o Juntor', 'class'=>'form-control']) }}
                </div> -->
                <div id="juntor"> 
                <br>
                <label for="selectDevices">Fabricante</label>
                 <select id="selectDevices" name="fabricante" class="form-control"> 
                    <option value='0' selected> Selecione  </option>
                    <option class="{{isset($final['khomp']) ? ' ' : 'hidden'}}" value="11"> KHOMP    </option>
                    <option class="{{isset($final['dahdi']) ? ' ' : 'hidden'}}" value="16"> Dahdi    </option>
                    <option class="{{isset($final['dgv']) ? ' ' : 'hidden'}}" value="14"> Digivoice  </option>
                 </select>
                <br>
                    <label for="selectFab" class='selectFab'>Placa</label>
                     
                      
                     <select id="selectFab" name="selectFab" class='form-control selectFab'> 
                     <option selected value='0'>Selecione a placa</option>
         
                    @if($boards)
                        
                       <p class='hidden'>{!! $i=0 !!}</p>
                       
                       @foreach ($boards as $board)
                            @if($board->tipo != 'FXS')
                                  <option value="{{$board->serial}}-b{{$i}}" class='khomp' > b{{$i}}  | serial:{{$board->serial}}  | portas:{{$board->portas}}  |  {{ isset( $board->tipo ) ? $board->tipo : '' }}</option>
                            @endif
                       <p class='hidden'> {!! $i++ !!} </p>

                       @endforeach

                    @endif  

                     <!-- @foreach ($canaisdgv as $canal)
                                <option value='{{$canal['nome']}}' class='dgv'>  Canal : {{$canal['nome']}}  |  Portas : {{$canal['portas']}}</option>
                     @endforeach -->

                    </select>
                     
                    <div id="channels">
                      <br>
                     <input type='button' id="selectAll" class='btn bControl' value='marcar todos'/>
                     <input type='button' id="deSelectAll" class='btn bControl' value='desmarcar todos'/><br>
                     <p class='hidden'>{!! $j=0 !!}</p>
                     <div id="portasKhomp" class='khomp'>

                       @if (!$boards)
                           <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                           <p class='text-danger'>Nenhuma Placa Adicionada</p>
                           <p class='text-danger'>Clique <a href="{{route('admin.hardware.index')}}">AQUI</a> para Adicionar uma</p> 
                       @else
                           @foreach ($boards as $board)
                           <div id="{{$board->serial}}" class="portas b{{$j}} portasKhomp">  
                              @if ($board->tipo == 'E1') <span class='hidden'> {{ $f = 0 }}    </span>
                                   @for ($i = 0 ; $i < $board->portas/30 ; $i++)
                                    <fieldset class='scheduler-border'><legend class='scheduler-border'> Link : {{ $i }}  </legend>
                                         @for ($y = $f ; $y < ($i+1) * 30 ; $y++) 
                                          <label class="labelp" for="{{'b'.$j.'c'.$y}} "> <input type="checkbox" id="{{'b'.$j.'c'.$y}}" value='{{'b'.$j.'c'.$y}}' class="porta" name='portas[]'/> {{$y}}</label>

                                         @endfor
                                         <span class='hidden'>
                                         {!!
                                          $f = $y 
                                         !!};
                                         </span> 
                                  
                                   </fieldset>
                                   @endfor
                              @else
                              
                                   @for ($i = 0 ; $i < $board->portas ; $i++)
                                        <label class="labelp" for="{{'b'.$j.'c'.$i}} "> <input type="checkbox" id="{{'b'.$j.'c'.$i}}" value='{{'b'.$j.'c'.$i}}' class="porta" name='portas[]'/> {{$i}}</label>
                                   @endfor
                         
                              @endif
                           </div>   <input type='text' id="b{{$j}}" class="board hidden " value='{{ isset($portasusadas['b'.$j]) ? implode('+', $portasusadas['b'.$j]) : '' }}' class='.buffer' />
                           <p class='hidden'>{!! $j++ !!}</p> 
                           @endforeach

                       @endif  
                   
                        <input id='stringbuffer' type ='text' value='' class = 'hidden'/>

                       </div>

                      <div id="portasDgv" class='dgv'>
                    
                       @if(!$canaisdgv)

                           <i class="fa fa-exclamation-triangle fa-2x" aria-hidden="true"></i>
                           <p>Nenhuma Placa Adicionada</p>
                           <p>Clique <a href="{{route('admin.hardware.index')}}">AQUI</a> para Adicionar uma</p>                         
                       @else
                        
                           <input id='stringbufferDgv' type ='text' value='{{ $totalportasdgv }}' class='hidden'/>
                           @foreach ($canaisdgv as $cdgv)
                                 <div id="{{$cdgv['nome']}}" class="portasDgv">     <fieldset class='scheduler-border'><legend class='scheduler-border'> 
                                  {{ isset($cdgv['sig']) ? ( $cdgv['sig'] == 'r2mfc_ndis_fixed' ? 'R2 - Ndis_Fixo'  : 
                                    ($cdgv['sig'] == 'r2mfc_ndis_variable' ? 'R2 - Ndis_Variável' :     
                                    ($cdgv['sig'] == 'gsm' ? 'GSM' : 
                                    ($cdgv['sig'] == 'isdn' ? 'E1' : 'sinalização_nao_identificada' ) )))   
                                    : 'erro_ao_identificar_signnaling'}}  </legend>

                                 @foreach ($cdgv['vetordecanais'] as $c)   
                                     <label class="labelp" for=""> <input type="checkbox" id="" value='{{$c}}' class="{{ $cdgv['nome'] }} portadgv" name='portas[]'/>{{ $c }}</label>
                                 @endforeach
                                 <br>
                               </div> 
                           @endforeach
                        @endif   
                      </div>
                    
                        @if(isset($totalCanaisDahdi))
                        <div id="portasDahdi" class="divDahdi"> 
                           <fieldset>
                                <legend> FXO </legend>
                                   @foreach ($totalCanaisDahdi as $cdahdi)                        
                                       <label for={{$cdahdi}}>{{$cdahdi}}</label><input id='dahdi{{$cdahdi}}' value={{$cdahdi}} type="checkbox" name='portas[]' class='portasDahdi'/>
                                   @endforeach
                            </fieldset>
                         </div>
                       <input type="text"  class='hidden' id="usadasDahdi" value="{{$portasUsadasDahdi}}">
                         @endif

        </center>
      </div>
      <div class="modal-footer">         
           <div id='cadFooter'>
            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
            <button type="submit" id="submit" class="btn btn-primary" >Cadastrar</button>
           </div>

           <div id='editFooter'> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" id="edit" class="btn btn-primary">Salvar</button>
           </div>
     {!! Form::close() !!}
     </div>
     

  

@endsection
@push('scripts')
<script src="/assets/js/jquery.maskedinput.min.js"> 

</script>

<script src="/assets/js/controleJuntor.js"></script> 


<script>
   sessionStorage.clear();
   function desligaOsOcultos(){
         $(':checkbox:hidden').each(function(){
              this.checked = false;
          });
   }
  
  function atualizaPortas(){
      window.reload();
  }

   function resetaForm(){
               console.log('resetaForm()');   
               $('#editFooter').hide();
               $('#cadFooter').show();
               $('#portasKhomp').hide();
               $('#portasDgv').hide();
               $('.bControl').hide();
               $('#portasDahdi').hide();   
               $('#selectDevices').val('0');
               $('.selectFab').show();
               $('#selectFab').val(0);

               $('input[type=checkbox] :enabled').prop('checked', false);
               $('#myModal')
                          .find("input[type!=checkbox]").not('#selectAll').not('#deSelectAll')
                             .val('')
                             .removeAttr('disabled')
                             .end()


      }

    $(function(){
     
       $('#nome_antigo').val( $('#nome').val() );
       sessionStorage.clear();
       $('.portas').hide();
       $('.bControl').hide();
       $('.portasDgv').hide();
       $('.khomp').hide();
       $('#editFooter').hide();
       $('#portasDahdi').hide();   
       
       $('body').on('hidden.bs.modal','.modal', function(){
          console.log('hidden Modal');
          resetaForm();
       });
       
        $('#submit').on('click', function(){
                    if (valida()){
                      $('#formEdit').submit();
                    }
        });

       desligaOsOcultos();
       $('#selectFab').val('null');

       if($('#selectDevices').val() !== '11' || $('#selectDevices').val() !== '14' || $('#selectDevices').val() !== '16'){
           $('#selectFab').attr('disabled', 'disabled');
       } else {
           $('#selectFab').removeAttr('disabled');
       }

       $('#selectFab').on('change',function(){ 
              $('.portas').hide();
              $('.portasDgv').hide();
              var valor =  $('#selectFab').val(); 

              $('.porta').each(function (){
                      this.checked = false;
              });
              
              switch( $('#selectDevices').val() ){
                  case '11': $('#'+valor.substr(0,5)).show();
                  break;
                  case '14': //$('#portasDgv').show(); //$('#'+valor).show(); $('.portadgv').attr('checked','checked');
                  break;
                  case '16':                      
                  break; //colocar o Dahdi 
               }
                
              $('.bControl').show();
              desligaOsOcultos();  
       }); 
            
        $('.board').each(function(){
             $('#stringbuffer').val( $('#stringbuffer').val() + $(this).val() + '+' );
        });
        
        $('#portasKhomp .porta').each(function(){
                 val = $('#stringbuffer').val();
                 var val = val.split('+');

                 if( val.indexOf( $(this).val() )  != -1 ){
                    $(this).attr('disabled', 'disabled');
                 }
        });
        
        var portasUsadasDahdi = $('#usadasDahdi').val().split(',');

        $('#portasDahdi .portasDahdi').each (function(){
            if (portasUsadasDahdi.indexOf( $(this).val() ) != -1 ){
              $(this).attr('disabled', 'disabled');
              $(this).attr('checked', 'checked');
            }
        });

        $('#selectDevices').on('change', function(){        
             switch( $('#selectDevices').val() )
                {
                  case '11': //khomp
                    $('#selectFab').removeAttr('disabled');
                    $('#selectFab').val(0);
                    $('.selectFab').show();
                    $('.khomp').show();
                    $('.dgv').hide();
                    $('.dahdi').hide(); 
                    $('#portasDahdi').hide(); 
                  break;
                  case '14': //dgv
                    $('#selectFab').removeAttr('disabled');
                    $('#selectFab').val(0);
                    $('.selectFab').hide();
                    $('.khomp').hide();
                    $('.dgv').show();
                    $('.portasDgv').show();
                    $('.dahdi').hide(); 
                    $('#portasDahdi').hide(); 
                    break;
                  case '16': //dahdi
                    $('#selectFab').removeAttr('disabled');
                    $('#selectFab').val(0);
                    $('.selectFab').hide();
                    $('.khomp').hide();
                    $('.dgv').hide();
                    $('#portasDahdi').show(); 
                   break;
                  default: 
                    $('#selectFab').attr('disabled', 'disabled');
                  break;
                }

                $('.portasKhomp').hide();                       
                $('.bControl').hide();
          }); 
           
           sessionStorage.setItem('portasDgv', "{{$totalportasdgv}}");

           $(".portadgv").each(function(){
                var el = $(this);
                //var portasUsadas = $("#stringbufferDgv").val();
                var portasUsadas = sessionStorage.getItem('portasDgv');
                portasUsadas = portasUsadas.split(',');
                var numero_porta = $(this).val();
                            
                if(portasUsadas.indexOf(numero_porta) > -1){
                      el.disabled = true;
                      el.attr('disabled', 'disabled');
                }
           });

           $('#selectAll').on('click',function(){ 
                console.log('Marcou todos');
                $(':checkbox:visible:enabled').each(function (){
                      this.checked = true;
                });       
           });

            $('#deSelectAll').on('click',function(){ 
                console.log('Desmarcou todos');
                $(':checkbox:visible:enabled').each(function (){
                      this.checked = false;
                });
            });

    });
</script>
@endpush 
