@extends('admin.base')
@section('content')
        <!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Centro de custo
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i><a href="{{route('admin.ramais.index')}}"> Ramais</a> / Centro de Custo
                </li>
            </ol>                   
      </div>
</div>

<br>
<a href="" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Cadastrar Centro de Custo</a><br> 

<table class='table tabelaCentralizada' id='tabelaCustos'>
    <thead>
        <td class='dtcenter'>Nome</td>
        <td>Crédito inicial</td>
        <td>Crédito atual</td>
        <td class='max-20'>Recarga <br>Mensal</td>
        <td>Ramais</td>
        <td>Ações</td>
    </thead>
    <tbody>
        
    </tbody>
</table>

@include('admin.custos.modalForm')


@push('scripts')
<script src='/assets/js/maskmoney.js'></script>
<script>

function penduraErros(erro){
  $('#div_lista_erros').show();
  $('#lista_erros').append('<li>'+erro+'</li>');
}

function valida(){
   console.log('validando...');
        
        $('#lista_erros').empty();
        
        var flag = 1;
        var nomesUsados = sessionStorage.getItem('nomes') != undefined ? sessionStorage.getItem('nomes').split(','): undefined;
        
        var nomeAntigo = $('#nomeAntigo').val();
        var nomeAtual = $('#nome').val();

        if(nomeAtual == ''){
            penduraErros('O campo nome é obrigatório.');
            flag = 0;
        } else if(nomeAtual.length < 2){
            penduraErros('O campo nome precisa ter no mínimo 2 digitos.');
            flag = 0;
        }

        var checkboxes = $('#div_ramais').find('input[type=checkbox]').filter(':checked');
        
        if(checkboxes.length < 1){
          penduraErros('Selecione pelo menos 1 ramal');
          flag=0;
        }

        if(nomesUsados != undefined && nomesUsados.indexOf(nomeAtual) != -1 && nomeAntigo != nomeAtual){
          penduraErros('Este código já está adicionado');
          flag=0;
        }

        if(flag == 1){
          return 1;
        }

        return 0;
}

function bloquearUsados(){
     todos_ramais = sessionStorage.getItem('ramais_usados') != undefined ? sessionStorage.getItem('ramais_usados').split(',') : '';

    for(var i = 0; i < todos_ramais.length ; i++){
                  $('#form_custos').find('input[type=checkbox][value='+todos_ramais[i]+']').prop('disabled', 'disabled');
            }
}

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
                     .removeAttr('disabled')                     
                     .end()  
                 .find("input[type=password]")
                     .val('')
                     .end()  
            
            $("#div_lista_erros").hide();

            $("#formBlackList").attr('action', "{{route('admin.custos.store')}}")
            
            bloquearUsados();
          
}

function showEdit(id){
      json = sessionStorage.getItem(id);
      json = JSON.parse(json);
      todos_ramais = sessionStorage.getItem('ramais_usados') != undefined ? sessionStorage.getItem('ramais_usados').split(',') : ''; 
      console.log(todos_ramais);
      

      ramais = json.ramais;
      ramais_vetor = [];
      


      for (var i = 0; i< ramais.length; i++ ){
          
          todos_ramais.splice( todos_ramais.indexOf( (''+ramais[i].id) ), 1)
          
          $('#form_custos').find('input[type=checkbox][value='+ramais[i].id+']').prop('checked',true).removeAttr('disabled');
                    
          $('#ramaisAntigos').val( $('#ramaisAntigos').val() +  ($('#ramaisAntigos').val() != '' ? ','+ramais[i].id : ramais[i].id));
      }
      

      for(var i = 0; i < todos_ramais.length ; i++){
          $('#form_custos').find('input[type=checkbox][value='+todos_ramais[i]+']').prop('disabled', 'disabled');
      }
      
      $('#nome').val(json.nome);
      $('#cred_valor').val(json.credito_atual);
      $('#credito_inicial').val(json.credito_inicial);
      $('#recarga_mensal').val(json.recarga_mensal);
      
      $('#myModal').modal('toggle');
      
      $("#form_custos").attr('action', '{{route('admin.custos.edit')}}/'+id)
           
      $('#nomeAntigo').val( $('#nome').val() );
}

</script>

<script>

 $(function(){


 $("#cred_valor").maskMoney({prefix:'R$ ', 
 showSymbol:true,
 thousands:'.',
 decimal:',',
 allowNegative: false,
 symbolStay: false});


  $('#editFooter').hide();
 $('#div_lista_erros').hide();
 sessionStorage.clear();

$('#myModal').on('hidden.bs.modal', function () {
     resetaForm();
})

 $('#edit').on('click', function(){
     if(valida()){
        $("#form_custos").submit();
     }     
});

 $('#enviar').on('click', function(){
      if(valida())
        $('#form_custos').submit();
 });
  

        $('#tabelaCustos').DataTable({
                processing: true,
                serverSide: true,
                info:false,
                "ajax": {
                    'url': '{!! route('datatables.Custos') !!}',
                    'type': 'GET', 
                },
                columns: [
                    { data: 'nome', name: 'nome'},
                    { data: 'credito_inicial', name:'credito_inicial'},
                    { data: 'credito_atual', name:'credito_atual'},
                    { data: 'recarga_mensal', name:'recarga_mensal'}
                ],
                columnDefs: [

                {
                "targets":5, 
                "render": function(data, meta, full){
                   
                    json = JSON.stringify(full);
                    sessionStorage.setItem(full.id, json);
                    
                    var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                    
                    btsActions += "<a href='{{route('admin.custos.destroy')}}/"+full.id+"/' data-id="+full.id+" data-action='confirm-delete' data-title='Exclusão' data-text='Deseja realmente deletar esse código?'"+full.numero+"' class='controlls-del' data-toggle='tooltip' title='Excluir'><i class='fa fa-times'></i></i></a>";
                  

                    return(btsActions);          
                }
                },{
                  "targets": 3,
                  "render": function(data){
                     if (data == 1){
                      return 'Sim';
                     } 
                      return 'Não';

                  }
                },{
                  "targets": 4,
                  "render": function(data,meta,full){
                         var nomes_ramais = '';

                         for(var i = 0 ; i< full.ramais.length ; i++)
                         {
                             vetorRamais = sessionStorage.getItem('ramais_usados');
                             if (vetorRamais != undefined && vetorRamais.indexOf(full.ramais[i].id) == -1)
                             {
                               sessionStorage.setItem('ramais_usados', vetorRamais+','+full.ramais[i].id);
                             }
                             else
                             {
                               sessionStorage.setItem('ramais_usados', full.ramais[i].id);
                             }

                             nomes_ramais += nomes_ramais != '' ? ', '+full.ramais[i].nome : full.ramais[i].nome;
                             
                             bloquearUsados();
                         }
                       
                       return nomes_ramais;
                   } 

                },{
                  "targets": [2,1],
                  "render": function(data,meta,full){              
                       return "R$ "+data;
                   } 

                }
                
                ]
                
            
            });
       

     });
    
</script>
@endpush
        <!-- Simple List -->

<!-- /.row -->
@endsection
