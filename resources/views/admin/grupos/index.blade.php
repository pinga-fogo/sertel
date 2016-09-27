@extends('admin.base')

@section('content')

<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Grupos de Atendimento
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i><a href="{{route('admin.ramais.index')}}"> Ramais</a> / Grupos de Atendimento
                </li>
            </ol>                   
      </div>
</div>

<a href="" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Adicionar Grupo</a><br>

@include('admin.grupos.modalForm')

@include('admin.grupos.datatables')

@endsection

@push('scripts')
<script src='/assets/js/select2.min.js'></script>
<script src='/assets/js/validador.js'></script>

<script>
 function showEdit(id){
      json = sessionStorage.getItem(id);
      json = JSON.parse(json);

      //troncos = json.tronco.split(',');

      $('#numero').val(json.numero);
      $('#tipo').val(json.tipo);
      $('#rota_dir').val(json.rota_dir);
      $('#tempo_chamada').val(json.tempo_chamada);
      $('#email').val(json.email);
      $('#correio_de_voz').bootstrapSwitch('state', json.correio_de_voz);

      var ramais = (json.ramais.toString()).split(',');
      console.log(ramais);
      
      $("#ramais").val(ramais).trigger('change');
       
        /*for(i in ramais){
          console.log(ramais[i]);
            $("#ramais").find('option[value='+ramais[i]+']').prop('selected', true);
        }*/
      // CRIAR A PARTE DOS JUNTORES
      // for (var i = 0 in ramais){
      //     $('#num_tronco').find('input[type=checkbox][value='+troncos[i]+']').prop('checked', true);
      // }
      
      $('#myModal').modal('toggle');

      $("#form_grupos").attr('action', "{{route('admin.grupos.update')}}/"+id+'')
      $('#editFooter').show();
      $('#cadFooter').hide();          
      
      $('#numeroAntigo').val( json.numero );
}

function resetaForm(){
               console.log('resetaForm()');   
               $('#editFooter').hide();
               $('#cadFooter').show();
               
               $('#myModal')
                          .find("input")
                             .val('')
                             .removeAttr('disabled')
                             .end()
                          .find("input[type=checkbox], input[type=radio]")
                             .prop("checked", "")
                             .removeAttr('disabled')
                             .end()
                          .find("option")
                             .show()
                             .end()
                          .find("select")
                            .not('ramais')
                            .val('0')
                            .removeAttr('disabled')
                            .end();
                
              $('#correio_de_voz').bootstrapSwitch('state', false);
}

</script>

<script type="text/javascript">
	$(function(){
    

    sessionStorage.clear();
  
    $('#div_lista_erros').hide();
    
    $('#div_email').hide();


    $('#correio_de_voz').on('switchChange.bootstrapSwitch',function(){
           $('#div_email').toggle();
    });
    
    $('#myModal').on('hidden.bs.modal', function(){
           resetaForm();
    });

    $("#editFooter").hide();

        
    $('#enviar').on('click', function(){
            if(valida()){
               $("#form_grupos").submit();
            }     
    });
    
    $('#edit').on('click', function(){
            if(valida()){
               $("#form_grupos").submit();
             }     
    });
    
    
    
	$.ajax({
	     'url':"{{route('datatables.ramais')}}",
	     'type': 'GET',
	      success: function(response){
              if(response.data.length < 1)
              {
              	 var emptyMsg = "<br><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i>\
                                    <p class='text-danger'>Nenhum Ramal Cadastrado</p>\
                                    <p class='text-danger'>Clique <a href='{{route('admin.ramais.index')}}'>AQUI</a> para Adicionar um.</p></div>";
                 $('.select2-container').after(emptyMsg);    
                 $('.selection').hide();
              } 
              else 
              {              
		              for (i in response.data){
		              	$('#ramais').append( $('<option value='+response.data[i].id+'>'+response.data[i].nome+'</option>') );
		              }
	            }     

          $('#ramais').select2();


          //faz o plugin select2 não ordenar os elementos quan do inseridos.
          $("#ramais").on("select2:select", function (evt){
              var element = evt.params.data.element;
              var $element = $(element);
              console.log($('#ramais').val());
              $element.detach();
              $(this).append($element);
              $(this).trigger("change");
          });
          

          /*faz o plugin select2 ser reordenável
           $('.select2-selection__rendered').sortable({
              containment: 'parent',
              start: function() { console.log('starting') },
              update: function() { console.log('updating')  }
           });*/
    

		      //ajeita o tamanho do campo
	          $('.select2-container').prop('style', 'min-width:30%');
	      }     
	      
	});
   
  
   

 
   

    
	});
</script>
@endpush