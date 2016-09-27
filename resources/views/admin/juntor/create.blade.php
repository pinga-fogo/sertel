@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Criar Juntor
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-list"></i>  <a href="{{ route('admin.juntor.listar') }}">Listagem</a>
            </li>
            <li class="active">
                <i class="fa fa-plus-circle"></i> Criar juntor 
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
        {!! Form::open(array('route' => 'admin.juntor.store', 'method'=>'POST')) !!}   
                {{csrf_field()}}                              
                <div class="form-group ">
                    {{ Form::label('nome', 'Nome') }}
                    {{ Form::text('nome', null, ['placeholder'=>'Digite o nome do Juntor', 'class'=>'form-control', 'required'=>'required']) }}
                </div>  
                <!--<div class="form-group">
                    {{ Form::label('juntor', 'Juntor') }}
                    {{ Form::text('juntor', null, ['placeholder'=>'Digite o Juntor', 'class'=>'form-control']) }}
                </div> -->
                <div id="juntor"> 
                <br>
                <label for="selectDevices">Fabricante</label>
                 <select id="selectDevices" name="fabricante" class="form-control"> 
                    <option class="" value='null' selected> Selecione  </option>
                    <option class="{{isset($final['khomp']) ? ' ' : 'hidden'}}" value="11"> KHOMP    </option>
                    <option class="{{isset($final['dahdi']) ? ' ' : 'hidden'}}" value="16"> Dahdi    </option>
                    <option class="{{isset($final['dgv']) ? ' ' : 'hidden'}}" value="14"> Digivoice  </option>
                 </select>
                <br>
                    <label for="selectFab" class='selectFab'>Placa</label>
                    <select id="selectFab" name="selectFab" class='form-control selectFab'> 
                     <option selected value='null'>Selecione a placa</option>
                     <p class='hidden'>{!! $i=0 !!}</p>
                     @foreach ($boards as $board)
                        <option value="{{$board['serial']}}-b{{$i}}" class='khomp' > b{{$i}}  | serial:{{$board['serial']}}  | portas:{{$board['portas']}}  |  {{ isset( $board['tipo'] ) ? $board['tipo'] : '' }}</option>
                    <p class='hidden'>  {!! $i++ !!} </p>
                     @endforeach

                    </select>
                     
                    <div id="channels">
                      <br>
                     <input type='button' id="selectAll" class='btn bControl' value='marcar todos'/>
                     <input type='button' id="deSelectAll" class='btn bControl' value='desmarcar todos'/><br>
                     <p class='hidden'>{!! $j=0 !!}</p>
                     
                         <div id="portasKhomp" class='khomp'>
                         @foreach ($boards as $board)
                         <div id="{{$board['serial']}}" class="portas b{{$j}} portasKhomp">  
                            @if ($board['tipo'] == 'E1') <span class='hidden'> {{ $f = 0 }}    </span>
                                
                                 @for ($i = 0 ; $i < $board['portas']/30 ; $i++)
                                     
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
                            
                                 @for ($i = 0 ; $i < $board['portas'] ; $i++)
                                      <label class="labelp" for="{{'b'.$j.'c'.$i}} "> <input type="checkbox" id="{{'b'.$j.'c'.$i}}" value='{{'b'.$j.'c'.$i}}' class="porta" name='portas[]'/> {{$i}}</label>
                                 @endfor
                       
                            @endif
                         </div>   <input type='text' id="b{{$j}}" class="board hidden " value='{{ isset($portasusadas['b'.$j]) ? implode('+', $portasusadas['b'.$j]) : '' }}' class='.buffer' />
                         <p class='hidden'>{!! $j++ !!}</p> 
                         @endforeach

                        <input id='stringbuffer' type ='text' value='' class = 'hidden'/>
                        </div>

                      <div id="portasDgv" class='dgv'>
                        
                      <input id='stringbufferDgv' type ='text' value='{{ $totalportasdgv }}' class = 'hidden'/>
                        
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
                          </fieldset>
                      
                     <div id="portasDahdi" class="portasDahdi"> 
                        <fieldset>
                            <legend> FXO  </legend>
                               @foreach ($totalCanaisDahdi as $cdahdi)                        
                                   <label for={{$cdahdi}}>{{$cdahdi}}</label><input id='{{$cdahdi}}' type="checkbox" name='portas[]' value='{{$cdahdi}}' class='portasDahdi'/>
                               @endforeach
                        </fieldset>
                     </div>
                <input type="text"  class='hidden' id="usadas" value=''>
                 
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                    <button type="reset" class="btn btn-default pull-right">Limpar</button>
                </div>
        {!! Form::close() !!}
</div>

<!-- /.row -->
@endsection

@push('scripts')
<script src="/assets/js/jquery.maskedinput.min.js"> 

</script>

<script>
   function desligaOsOcultos(){
         $(':checkbox:hidden').each(function(){
              this.checked = false;
          });
   }
   
    $(function(){
       
       $('.portas').hide();
       $('.bControl').hide();
       $('.portasDgv').hide();
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
                  $('#portasDahdi').show();   $('#channels').show();      
                  break; 
               }
                
              $('.bControl').show()
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


        $('#portasDgv .portadgv').each(function(){
               var val = $('#stringbufferDgv').val();
               var val = val.split(',');
               
               if( val.indexOf( $(this).val()) != -1){
                   this.checked = true;
                   $(this).attr('disabled', 'disabled');
               }     
        });

         $('#selectDevices').on('change', function(){
             switch( $('#selectDevices').val() )
                {
                  case '11': //khomp
                    $('#selectFab').removeAttr('disabled');
                    $('#selectFab').val("null");
                    $('.khomp').show();
                    $('.dgv').hide();
                    $('.dahdi').hide(); 
                    $('.selectFab').show();
                  break;
                  case '14': //dgv
                    $('#selectFab').removeAttr('disabled');
                    $('#selectFab').val("null");
                    $('.selectFab').hide();
                    $('.khomp').hide();
                    $('.dgv').show();
                    $('.portasDgv').show();
                    $('.dahdi').hide(); 
                  break;
                  case '16': //dahdi
                    console.log('foi');
                    $('#selectFab').removeAttr('disabled');
                    $('#selectFab').val("null");
                    $('.selectFab').hide();
                    $('.khomp').hide();
                    $('.dgv').hide();
                    $('.dahdi').show(); 
                  break;
                  default: 
                    $('#selectFab').attr('disabled', 'disabled');
                  break;
                }
              
                $('.portasKhomp').hide();                       
                $('.bControl').hide();
         });
  
           $('#selectAll').on('click',function(){ 
                console.log('Marcou todos');
                $(':checkbox:visible').each(function (){
                      this.checked = true;
                });       
           });

            $('#deSelectAll').on('click',function(){ 
                console.log('Desmarcou todos');
                $(':checkbox:visible').each(function (){
                      this.checked = false;
                });
           });

    });
</script>
@endpush 