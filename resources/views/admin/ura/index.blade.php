@extends('admin.base')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Uras
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <!-- <i class="fa fa-list"></i> <a href="{{route('admin.ramais.index')}}">Ramais</a> --> URAS

                </li>      

                     <a href='#' id='open_saudacoes'><span style="float:right; margin-right:10px" class="label label-primary"><i class="fa fa-users fa-2x" aria-hidden="true"></i>&nbsp Saudações </span></a>          
            </ol>                   
      </div>
    </div>

    <!-- /.row -->
    <div class='row'> 
    <!--<a href="{{route('admin.ramais.create')}}" class="btn btn-block btn-info"><span class="glyphicon glyphicon-plus"></span> Criar Novo Ramal</a><br> -->
    <a id='createButton' class="btn btn-block btn-info btn btn-info gsm_khomp digital_khomp" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Nova URA</a><br> 

    @include('admin.ura.modalform')
    <!-- <button type="button" class="btn btn-info gsm_khomp digital_khomp" data-toggle="modal" data-target="#myModal">Nova Cadência</button> -->
    @include('admin.ura.datatables')

    @include('admin.ura.saudacoes.modalform');

@endsection

@push('scripts')
<script src="/assets/js/validador.js"></script>

<script>

function showEditSaudacoes(){

      $.ajax({
          "url": "{{ route('datatables.saudacoes') }}",
          "type":"GET",
          "success": function(saudacoes){
          console.log(saudacoes);
              saudacoes.data.map(function(el){
                   
                   switch(el.nome){
                    case 'bom dia':
                          $("select[name=bom_dia_audio]").val(el.audio);
                    break;


                     case 'boa tarde':
                          $("select[name=boa_tarde_audio]").val(el.audio);
                    break;


                     case 'boa noite':
                          $("select[name=boa_noite_audio]").val(el.audio);
                    break;


                     case 'fechado':
                          $("select[name=fechado_audio]").val(el.audio);
                    break;

                   }
              });
              
          }
      });
}

function showEdit(id){
      json = sessionStorage.getItem(id);
      json = JSON.parse(json);      

      $('#nome').val(json.nome);
      
      var result = $.map(json, function(val, key) {
                  var uniques = ['nome', 'playback', 'background', 'created_at', 'updated_at'];
                  var semana =  ['dom', 'seg', 'ter', 'qua', 'qui','sex','sab'];

                  if(uniques.indexOf(key) == -1 && semana.indexOf(key) == -1){
                      
                      if(val != null && val != undefined){
                        values = val.toString().split(';');

                        $('select[name='+key+'_tipo]').val(values[0]);
                        $('select[name='+key+'_destino]').val(values[1]);
                      }

                  } else {

                    $("#nome").val(json.nome);
                    $("#playback").val(json.playback);
                    $("#background").val(json.background);

                    $("input[name=ativ_saudacoes]").bootstrapSwitch('state', json.ativ_saudacoes, true);
                    $("input[name=ativ_fechado]").bootstrapSwitch('state', json.ativ_fechado, true);

                    $("input[name=hora_dom]").val(json.dom);
                    $("input[name=hora_seg]").val(json.seg);
                    $("input[name=hora_ter]").val(json.ter);
                    $("input[name=hora_qua]").val(json.qua);
                    $("input[name=hora_qui]").val(json.qui);
                    $("input[name=hora_sex]").val(json.sex);
                    $("input[name=hora_sab]").val(json.sab);
                    
                  }
                  
                  return;
            });
     

      $('#myModal').modal('toggle');
      
      $("#formUra").attr('action', '{{route('admin.uras.update')}}/'+id);
           
      //$('#nomeAntigo').val( $('#nome').val() );
}

$(function(){
sessionStorage.clear();

populaSelects();


$('#myModal').on('hidden.bs.modal', function () {
     resetaForm();
})

$('#saudacoesModal').on('hidden.bs.modal', function () {
     resetaForm();
})

$('#editFooter').hide();


$("#enviar").on('click', function(){
      $("#formUra").submit();
});


$("#saudacoes_enviar").on('click', function(){
      $("#formSaudacoes").submit();
});

$("#open_saudacoes").on('click', function(){
       showEditSaudacoes();
       $("#saudacoesModal").modal('show');
});

//função que pega somente os ramais tipo ura do objeto;

$(".select_tipo").on('change', function(){
      var el = $(this);
      var tipo = el.val();
      var select_options = '';

      if(el.prop('id') == 'digito_invalido'){

            select_options = $("#digito_invalido_opt");

      } else if(el.prop('id') == 'time_out') {

            select_options = $("#time_out_opt");

      } else {

            select_options = el.closest('tr').find('select.select_opts');
      
      }

      var options = select_options.find('option');

      options.show();
      options.not('.c_no').not('.c_'+tipo).hide();
      select_options.val('no');  

      select_options.focus();    
      //select_options.val(select_options.find('option:visible')[0].val());
});


function resetaForm(){
               console.log('resetando formulário...');   
               $('#editFooter').hide();
               $('#cadFooter').show();
               
               $('#myModal')
                  .find("input[type=text]")
                     .val('')
                     .end()
                  .find("select").not('#nome')
                     .val('no')
                     .end()

                $("#saudacoesModal").find("select").val('no');
              

                $('.switch').each(function(){
                    $(this).bootstrapSwitch('state', false, true);
                });

                $('.horas-atendimento-form').each(function(){
                    $(this).val('00:00-00:00');
                });

               //$("#div_lista_erros").hide();
               $("#formBlackList").attr('action', "{{route('admin.custos.store')}}")
            
}



function erroVazio(){
        $(".divNome").hide();

        var emptyMsg = "<br><div><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i>\
                                    <p class='text-danger'>Nenhum Ramal URA Cadastrado</p>\
                                    <p class='text-danger'>Clique <a href='{{route('admin.ramais.index')}}'>AQUI</a> para Adicionar um.</p></div>";
        $('.divNome').after($(emptyMsg)); 
}


function populaSelects(){

      //pega os ramais para os Selects do formulário
      $.ajax({
          "url": "{{ route('datatables.ramais') }}",
          "type":"GET",
          "success": function(ramais){
             if(ramais.data.length >= 1){
                  //contador para contar quantas uras tem
                  //se não ouver nenhuma exibe a mensagem de erro

                  count = 0;

                  ramais.data.map( function(el){ 
                  
                        //se for URA pendura no campo no nome, 
                        if(el.aplicacao == '113'){
                             
                             count++;
                             option = '<option class="c_ura" value='+el.id+'>'+el.nome+'</option>';
                             
                             $("#nome").append($(option));
                        
                        //se não for ura pendura com uma classe diferente
                        //no campo de opções dos dígitos.
                        } else {

                             option = '<option class="c_ramal" value='+el.id+'>'+el.nome+'</option>';

                        }

                        $(".select_opts").each(function(){
                                $(this).append($(option));
                                $(this).find('option').hide();
                        });
                        

                  });

                  if(count < 1)
                      erroVazio();
             
             }  else {
                erroVazio();
             }

          }
      });


      $.ajax({
          "url": "{{ route('datatables.voice_mail') }}",
          "type":"GET",
          "success": function(voice_mails){
         
              if(voice_mails.data.length >= 1){

                  voice_mails.data.map(function(el){
                      var option = '<option class="c_voice_mail" value='+el.id+'>'+el.nome+'</option>';
                      $(".select_opts").each( function(){ $(this).append($(option)) 
                          $(this).find('option').hide();
                       });
                  });
              }
              
          }
      });

      $.ajax({
          "url": "{{ route('datatables.Grupos') }}",
          "type":"GET",
          "success": function(grupos){
         
              if(grupos.data.length >= 1){

                  grupos.data.map(function(el){
                      var option = '<option class="c_grupo" value='+el.id+'>'+el.numero+'</option>';
                      $(".select_opts").each( function(){ 
                        $(this).append($(option));
                           $(this).find('option').hide();
                      });
                     

                  });
              }
              
          }
      });


      $.ajax({
          "url": "{{ route('datatables.audios') }}",
          "type":"GET",
          "success": function(audios){
         
              if(audios.data.length >= 1){

                  audios.data.map(function(el){
                      var option = '<option class="c_audio" value='+el.id+'>'+el.nome+'</option>';
                      
                      $("#background").append($(option));
                      $("#playback").append($(option));

                      $(".form_saudacoes").each(function(){
                           $(this).append($(option));
                         });
                    
                      $(".select_opts").each( function(){ 
                          $(this).append($(option)) 
                           $(this).find('option').hide();
                      });
                  });
              }
              
          }
      });

    
}


});

</script>
@endpush