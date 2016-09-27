@extends('admin.base')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Troncos
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i> Troncos
                </li>

                <a href='{{route("admin.hardware.list")}}'><span style="float:right; margin-right:10px" class="label label-primary"><i class="fa fa-cog fa-2x" aria-hidden="true"></i>&nbsp Hardwares</span></a>

                <a href='{{route("admin.juntor.listar")}}'><span style="float:right; margin-right:10px" class="label label-primary"><i class="fa fa-cog fa-2x" aria-hidden="true"></i>&nbsp Juntores</span></a>

                <a href='{{route("admin.centrais.index")}}'><span style="float:right; margin-right:10px" class="label label-primary"><i class="fa fa-sitemap fa-2x" aria-hidden="true"></i>&nbsp Matriz - Filiais</span></a>
                
            </ol>
        </div>
    </div>
    <!-- /.row {{route('admin.troncos.create')}}-->
<a href="" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Criar Troncos</a><br>

    {{-- para carregar listagem normal sem data table --}}
    {{-- @include('admin.accounts.list') --}}

    {{-- para carregar listagem com data table --}}
    @include('admin.troncos.datatableTroncos')


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div id='msgFeedBack' class='alert alert-danger hidden'>
          <ul id='listaerros'>
              
          </ul>
        </div>
        <h4 class="modal-title" id="modalDefaultTitle"></h4>
      </div>
      <div class="modal-body" id="modalDefaultBody">
       <form action='{{route('admin.troncos.store')}}' id='formTroncos'>
        <center>
        @include('admin.troncos.troncosFormFields')
        </center>
      </div>
      <div class="modal-footer">
           <div id='cadFooter'>
            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
            <button type="button" id="enviar" class="btn btn-primary" >Cadastrar</button>
           </div>
          
           <div id='editFooter'> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" id="edit" class="btn btn-primary">Salvar</button>
           </div>
     <!-- {!! Form::close() !!}-->
      </div>
     </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="/assets/js/validador.js"></script>
<script src="/assets/js/controleTroncos.js"></script>
 <script>
/*function store(){
  var data = getData();
  $.ajax({
                url: "{{route('admin.troncos.store')}}", //this is the submit URL
                type: 'get', //or POST
                data: data,
                success: function(){
                     console.log('successfully submitted');
                }
  });
 }

 function editTronco(id){
  var data = getData();
  data.id= id;
 
  $.ajax({
                url: "{{route('admin.troncos.update')}}", //this is the submit URL
                type: 'get', //or POST
                data: data,
                success: function(){
                     console.log('successfully submitted');
                     location.reload();
                }
  });
 }*/

</script> 
<script>
    

$(function(){
      $('#editFooter').hide();
      sessionStorage.clear();
      resetaForm();

      $('button#enviar').on('click', function(){
           if(valida()){
                $('#formTroncos').submit();
                //location.reload();
           }  
      });
 });


function delCadencia(id){
    $.ajax({
                    url: "{{route('admin.troncos.delCadencias')}}/"+id+"", //this is the submit URL
                    type: 'get', //or POST
                    success: function(response){
                        if(response){
                              $('#div_cads_personalizadas').find('#'+id).remove();
                        }                         
                    }
    });
}


function delCadencia_NA(nome){
      $('#div_cads_personalizadas').find('#'+$(nome).attr('id')).remove();
}


function getCadencias(id){
        $.ajax({
                url: "{{route('admin.troncos.getCadencias')}}/"+id+"", //this is the submit URL
                type: 'get', //or POST
                success: function(response){
                    
                    if(response != 0){
                         console.log(response);
                         for(var i = 0; i < response.length ; i++)
                         { 
                              if( !$('#'+response[i].nome+'').length )
                              {
                                  var foo = ("\
                                    <div id="+response[i].id+">\
                                     <label for="+response[i].nome+">"+response[i].nome+"&nbsp</label><input type=text class='form-cadencia' value="+response[i].valor+" /> <a href='javascript:delCadencia("+response[i].id+")' class='fake-linkRed'> <i class='fa fa-times' aria-hidden='true'></i></a><br>\
                                     </div><br>");  
                                   
                                   $('#div_cads_personalizadas').append($(foo));
                              }     
                         }
                     
                      $('.cads_personalizadas').show();
       
                    }                         
                }
        });
}

function showEdit(id){
               console.log('showEdit()');
               json = sessionStorage.getItem(id);
               json = JSON.parse(json);
 
               getCadencias(id);

               $('#formTroncos').attr('action',  "{{route('admin.troncos.update')}}/"+id+"" );
                 
                $('#edit').on('click', function(){
                          if( valida() ){
                              $('#formTroncos').submit();
                          } 
                }); 
                
                //recupera o valor do prefixo de saida.
                var prefixo = json.prefx_saida;
                console.log('prefixo: '+prefixo);
                if(prefixo != undefined){

                   if( prefixo.substr(0, 2) == '55'){
                        
                        if(prefixo.length == 2){
                        
                             json.prefx_saida = 12;
                        
                        } else if(prefixo.length == 3){

                             json.prefx_saida = 13;
                        
                        } else if(prefixo.length > 3){

                             json.prefx_saida = 14;
                        
                        }

                   } else {
                        
                        if(prefixo.length == 1){
                        
                             json.prefx_saida = 11;
                        
                        } else if(prefixo.length == 2){

                             json.prefx_saida = 16;
                        
                        } else if(prefixo.length > 2){

                             json.prefx_saida = 15;
                        
                        }
                   }
                }


                $('#cadFooter').hide(),       
                $('#editFooter').show();
                $('input[name=antigos]').val(json.nome+';'+json.number);                                          
              
                $('#nome').val(json.nome),
                $('#tecnologia').val(json.tecnologia),
                $('#JuntorSelect').val( $('#JuntorSelect').find("option[value^='"+json.juntor+"']").val() );  
                $('#prefx_juntor').val(json.prefx_juntor),
                $('#tipo').val(json.tipo),
                $('#rota').val(json.rota),
                $('#rota_dir').val(json.rota_dir),
                $('#prefx_entrada').val(json.prefx_entrada),
                $('#prefx_saida').val(json.prefx_saida),
                $('#conta_registro').val(json.conta_registro),
                $('#senha_registro').val(json.senha_registro),
                $('#dominio').val(json.dominio),
                $('#host').val( json.host );
                $('#proxy').val(json.proxy),
                $('#protocolo').val(json.protocolo),
                $('#type').val( json.tipo ),
                $('#juntor_atend').val(json.juntor_atend),
                $('#juntor_cod_acess').val(json.juntor_cod_acess),
                $('input[name=reenc_chamadas]').bootstrapSwitch('state', (json.reenc_chamadas) == '1' ? true : false),
                $('input[name=qualify]').bootstrapSwitch('state', (json.qualify) == '1' ? true : false),
                $('input[name=reinvite]').bootstrapSwitch('state', (json.reinvite) == '1' ? true : false),
                $('input[name=pro_band]').bootstrapSwitch('state', (json.pro_band) == '1' ? true : false),
                $('#nat').val(json.nat),
                $('#dtmf_mode').val(json.dtmf_mode),
                $('#insecure').val(json.insecure),
                $('#contexto').val(json.contexto),
                $('#porta').val(json.porta),
                $('#audio_rx_sync').val(json.audio_rx_sync),
                $('#context_gsm_call').val(json.context_gsm_call),
                $('#context_gsm_sms').val(json.context_gsm_sms),
                $('#context_digital').val(json.context_digital),
                $('#volume_tx').val(json.volume_tx),
                $('#volume_tx_v').val(json.volume_tx),                
                $('#volume_rx').val(json.volume_rx),
                $('#volume_rx_v').val(json.volume_rx),                
                $('#suprimir_id').val(json.suprimir_id),
                $('#block_call').val(json.block_call),
                $('#disconnect_call').val(json.disconnect_call),
                $('#context_fxo').val(json.context_fxo),
                $('#context-fxo-alt').val(json.context_fxo_alt),
                $('#fxo_fsk_detection').val(json.fxo_fsk_detection),
                $('#fxo_fsk_timeout').val(json.fxo_fsk_timeout),
                $('#fxo_user_xfer_delay').val(json.fxo_user_xfer_delay),
                $('#fxo_send_pre_audio').val(json.fxo_send_pre_audio),
                $('#fxo_busy_disconnection').val(json.fxo_busy_disconnection),
                $('#fidelidade').val(json.fidelidade),
                $('#remover_prefixo').val(json.remover_prefixo),
                $('#language').val(json.language),
                $('#mohclass').val(json.mohclass),
                $('#flash_behaviour').val(json.flash_behaviour),
                $('#pendulum_digits').val(json.pendulum_digits),
                $('#pendulum_hu_digits').val(json.pendulum_hu_digits),
                $('#nome_cad').val(json.nome_cad),
                $('#val_cad').val(json.val_cad)    
                if(json.ccss_enable != undefined)   
                $('#ccss_enable').val(json.ccss_enable.replace('%3D', '='));
                if(json.co_dialtone != undefined)
                $('#co_dialtone').val(replaceAll(json.co_dialtone, '%252C' , ' ') );
                if(json.vm_dialtone != undefined)
                $('#vm_dialtone').val( replaceAll(json.vm_dialtone, '%252C' , ' ') );
                if(json.pbx_dialtone != undefined)
                $('#pbx_dialtone').val(replaceAll(json.pbx_dialtone, '%252C' , ' ') );
                if(json.fast_busy != undefined)
                $('#fast_busy').val(replaceAll(json.fast_busy, '%252C' , ' ') );
                if(json.ring_back != undefined)
                $('#ring_back').val(replaceAll(json.ring_back, '%252C' , ' ') );
                if(json.waiting_call != undefined)
                $('#waiting_call').val(replaceAll(json.waiting_call, '%252C' , ' ') );
                if(json.ring != undefined)
                $('#ring').val(replaceAll(json.ring, '%252C' , ' ') );
       //arranque
      arranque()
      
      changeJuntorTec();
            

      $('#myModal').modal('toggle');
}


function resetaForm(){
                    console.log('resetaForm()');   
                    $('#formTroncos').attr('action', "{{route('admin.troncos.store')}}");
                    $('#div_cads_personalizadas').empty();
                    $('#editFooter').hide();
                    $('#cadFooter').show();
                    
                    $('#myModal')
                               .find("select")
                                  .val(0)
                                  .end()
                               .find("input")
                                  .val('')
                                  .removeAttr('disabled')
                                  .end()
                               .find("option")
                                  .show()
                                  .end()           
                    
                  $('#type').val(11);
                  $('#nat').val(11);
                  $('#dtmf_mode').val(11);
                  $('#insecure').val('Port, Invite');
                  $('#contexto').val('Sertel');
                  $('#porta').val('5060');

                  $('#newcad').hide();

                  $('.gsm_khomp').hide();
                  $('.form-ip').hide();
                  $('.form_facip').hide();
                  $('.div_prefx_sa').hide();
                  $('.div_prefx_en').hide();
                  $('#opAvanc').hide();
                  $('.digital_khomp').hide();
                  $('.analog_khomp').hide();
                  $('.prefx_juntor').hide();

                  $("#fidelidade_field").show();

                  resetaCheckBoxes();                 
                  removeErrors();
}             

</script>
@endpush
