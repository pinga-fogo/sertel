@extends('admin.base')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           White List
        </h1>
        <ol class="breadcrumb">
            <li class='active'>
                <i class="fa fa-list"></i>  <a href="{{route('admin.prefixos.index')}}"> Prefixos</a> / White List
            </li>
        </ol>
    </div>
</div>
		<a href="" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Adicionar Número</a><br> 
		<table id='whiteListTable' class='table tgHardware troll-border sorting_1'>
		<thead>
		 	<td> Número </td>
		 	<td> Troncos </td>
      <td> Ações </td>
		</thead>
		</table> 

</div>



@include('admin.whitelist.modalForm')

@endsection
@push('scripts')
<script src="/assets/js/jquery.maskedinput.min.js"></script>

<script>
function resetaForm(){
	             console.log('resetando formulário...');   
	             $('#editFooter').hide();
	             $('#cadFooter').show();
	             
	             $('#myModal')
	                .find("input[type=text]")
	                   .val('')
	                   .removeAttr('disabled')
	                   .end()
	                .find("input[type=checkbox]")
	                   .prop('checked', false)
	                   .end()  

           
            $("#formWhiteList").attr('action', "{{route('admin.white_list.setNum')}}")
            $("#div_lista_erros").hide();
}

function showEdit(id){
      json = sessionStorage.getItem(id);
      json = JSON.parse(json);

      $('#numero').val(json.numero);
      
      troncos = json.tronco.split(',')
    
      if(troncos != ''){
          for (var i = 0 in troncos){
              $('#num_tronco').find('input[type=checkbox][value='+troncos[i]+']').prop('checked', true);
          }
          $('#div_empty_error').hide();
      } else {
          $('#div_empty_error').show();
      }

      $('#myModal').modal('toggle');

      $("#formWhiteList").attr('action', "{{route('admin.white_list.update')}}/"+id+'')
                 
      $('#numeroAntigo').val( $('#numero').val() );

}

function penduraErros(erro){
  $('#div_lista_erros').show();
  $('#lista_erros').append('<li>'+erro+'</li>');
}

function valida(){
        console.log('validando...');
        
        $('#lista_erros').empty();
        
        var flag = 1;
        var numerosUsados = sessionStorage.getItem('numeros') != undefined ? sessionStorage.getItem('numeros').split(','): undefined;
        
        var numeroAntigo = $('#numeroAntigo').val();
        var numeroAtual = $('#numero').val();
        console.log('antigo:' + numeroAntigo)
        console.log('atual:' + numeroAtual)

        if(numeroAtual == ''){
            penduraErros('O campo número é obrigatório.');
            flag = 0;
        } else if(numeroAtual.length < 3){
            penduraErros('O campo número precisa ter no mínimo 3 digitos.');
            flag = 0;
        }

        var checkboxes = $('#myModal').find('input[type=checkbox]').filter(':checked');

        if(checkboxes.length < 1 ){
           penduraErros('Selecione pelo menos 1 tronco.')
           flag = 0;
        }
        
        
        if(numerosUsados != undefined && numerosUsados.indexOf(numeroAtual) != -1 && numeroAntigo != numeroAtual){
          penduraErros('Este número já está adicionado');
          flag=0;
        }

        if(flag == 1){
          return 1;
        }

        return 0;
} 


</script>

<script>

$(function(){
    $('#numero').focusout(function(){
          var phone, element;
          element = $(this);
          element.unmask();
          phone = element.val().replace(/\D/g, '');
          if(phone.length > 10) {
            element.mask("(99) 99999-999?9");
          } else {
            element.mask("(99) 9999-9999?9");
          }
        }).trigger('focusout');

    $('#selectAll').on('click', function(){
       $('#num_tronco').find("input[type=checkbox]").prop('checked', true);
    });
    $('#deSelectAll').on('click', function(){
       $('#num_tronco').find("input[type=checkbox]").prop('checked', false);
    });
    
    $("#div_lista_erros").hide();
    sessionStorage.clear();
    $("#editFooter").hide();
    $('#myModal').on('hidden.bs.modal', function () {
         resetaForm();
    });
        
    $('#enviar').on('click', function(){
            if(valida()){
               $("#formWhiteList").submit();
            }     
    });
    
     $('#edit').on('click', function(){
            if(valida()){
               $("#formWhiteList").submit();
             }     
     });

     table = $('#whiteListTable').DataTable({
            processing: true,
            serverSide: true,
            info:false,
            "ajax": {
                'url': '{!! route('datatables.WhiteList') !!}',
                'type': 'GET', 
            },
            columns: [
                { data: 'numero', name: 'numero'},
                { data: 'nomeTronco', name:'nomeTronco'},
             ],
            "columnDefs": [  
                { 
                  "targets":2,
                  "render": function(data, meta , full){
                    json = JSON.stringify(full);
                    sessionStorage.setItem(full.id, json);
                    
                    var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                    
                     btsActions += "<a href='{{route('admin.white_list.destroy')}}/"+full.id+"/' data-id="+full.id+" data-action='confirm-delete' data-title='Exclusão' data-text='Deseja realmente deletar esse número?'"+full.numero+"' class='controlls-del' data-toggle='tooltip' title='Excluir'><i class='fa fa-times'></i></i></a>" ;
                    
                    return(btsActions);
                  }
                },
                {
                  "targets":0,
                  "render":function(data, meta, full){
                   
                   var vetorNumeros = sessionStorage.getItem('numeros') != undefined ? sessionStorage.getItem('numeros').split(',') : '';
                    
                    if(vetorNumeros.indexOf(data) == -1){ 
                         sessionStorage.setItem('numeros', sessionStorage.getItem('numeros') != undefined ? sessionStorage.getItem('numeros')+','+data : data);
                    }

                    return(data);
                  }
                },
                {
                   "targets":1,
                   "render": function(data, meta, full){

                      console.log(full.nomeTronco);
                      return(data);
                   }
                }
                ]
        });

        $('#whiteListTable_length').hide(); /*** REMOVE O CABEÇALHO INDESEJADO DA TABELA... SOLUÇÃO PROVISÓRIA***/
    });
</script>
@endpush