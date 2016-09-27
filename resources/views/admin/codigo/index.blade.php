@extends('admin.base')
@section('content')
        <!-- Page Heading -->
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Código de Contas
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i><a href="{{route('admin.ramais.index')}}"> Ramais </a> / Código de Contras
                </li>
            </ol>                   
      </div>
</div>
<br>

<a href="" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Criar Código de Conta</a><br> 

<table class='table' id='tabelaCodigos'>
    <thead>
        <td>Código</td>
        <td>Nome</td>
        <td>Bloqueios</td>
        <td>Ações</td>
    </thead>
    <tbody>
        
    </tbody>
</table>

@include('admin.codigo.modalForm')


@push('scripts')
<script>

function penduraErros(erro){
  $('#div_lista_erros').show();
  $('#lista_erros').append('<li>'+erro+'</li>');
}

function valida(){
   console.log('validando...');
        
        $('#lista_erros').empty();
        
        var flag = 1;
        var codigosUsados = sessionStorage.getItem('codigos') != undefined ? sessionStorage.getItem('codigos').split(','): undefined;
        
        var codigoAntigo = $('#codigoAntigo').val();
        var codigoAtual = $('#cod_conta').val();

        if(codigoAtual == ''){
            penduraErros('O campo código é obrigatório.');
            flag = 0;
        } else if(codigoAtual.length < 3){
            penduraErros('O campo código precisa ter no mínimo 3 digitos.');
            flag = 0;
        }

        if($('#nome').val() == ''){
            penduraErros('O campo nome é obrigatório.');
            flag = 0;
        } else if(codigoAtual.length < 3){
            penduraErros('O campo nome precisa ter no mínimo 3 digitos.');
            flag = 0;
        }

        if($('#senha').val() == ''){
            penduraErros('O campo senha é obrigatório.');
            flag = 0;
        } else if(codigoAtual.length < 3){
            penduraErros('O campo senha precisa ter no mínimo 3 digitos.');
            flag = 0;
        }

        var checkboxes = $('#myModal').find('input[type=checkbox]').filter(':checked');

        if(checkboxes.length < 1 ){
           penduraErros('Selecione pelo menos 1 tipo de bloqueio.')
           flag = 0;
        }
        
        if(codigosUsados != undefined && codigosUsados.indexOf(codigoAtual) != -1 && codigoAntigo != codigoAtual){
          penduraErros('Este código já está adicionado');
          flag=0;
        }

        if($('#senha').val() != $('conf_senha').val() && $('conf_senha').is(':visible')){
          penduraErros('A senha precisa ser igual à confirmação');
          flag=0;
        }

        if(flag == 1){
          return 1;
        }

        return 0;
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
                     .end()  
                 .find("input[type=password]")
                     .val('')
                     .end()  
            
            $('#div_conf_senha').show();
            $("#div_lista_erros").hide();

            $("#formBlackList").attr('action', "{{route('admin.codigos.store')}}")


}

function showEdit(id){
      json = sessionStorage.getItem(id);
      json = JSON.parse(json);
      $('#div_conf_senha').hide();
      var bloqueios = json.bloqueios.split(',');
 
      $('#cod_conta').val(json.codigo);
      $('#nome').val(json.nome);
      $('#senha').val(json.senha);
      
      for (var i = 0 in bloqueios){
          $('#bloqueios').find('input[type=checkbox][value='+bloqueios[i]+']').prop('checked', true);
      }
      
      $('#myModal').modal('toggle');
      
      $("#form_codigos").attr('action', '{{route('admin.codigos.edit')}}/'+id)
           
      $('#codigoAntigo').val( $('#cod_conta').val() );
}

</script>

<script>
 $('#editFooter').hide();
 $('#div_lista_erros').hide();
 sessionStorage.clear();

$('#myModal').on('hidden.bs.modal', function () {
     resetaForm();
})

 $('#edit').on('click', function(){
     if(valida()){
        $("#form_codigos").submit();
     }     
});

 $('#enviar').on('click', function(){
      if(valida())
        $('#form_codigos').submit();
 });

 $(function(){
        $('#tabelaCodigos').DataTable({
                processing: true,
                serverSide: true,
                info:false,
                "ajax": {
                    'url': '{!! route('datatables.Codigos') !!}',
                    'type': 'GET', 
                },
                columns: [
                    { data: 'codigo', name: 'codigo'},
                    { data: 'nome', name:'nome'},
                    { data: 'bloqueios', name:'bloqueios'}
                ],
                columnDefs: [

                {
                "targets":3, 
                "render": function(data, meta, full){
                   
                    json = JSON.stringify(full);
                    sessionStorage.setItem(full.id, json);
                    
                    var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                    
                    btsActions += "<a href='{{route('admin.codigos.destroy')}}/"+full.id+"/' data-id="+full.id+" data-action='confirm-delete' data-title='Exclusão' data-text='Deseja realmente deletar esse código?'"+full.numero+"' class='controlls-del' data-toggle='tooltip' title='Excluir'><i class='fa fa-times'></i></i></a>";

                    var vetorCodigos = sessionStorage.getItem('codigos') != undefined ? sessionStorage.getItem('codigos').split(',') : '';
                    
                    if(vetorCodigos.indexOf(full.codigo) == -1){ 
                         sessionStorage.setItem('codigos', sessionStorage.getItem('codigos') != undefined ? sessionStorage.getItem('codigos')+','+full.codigo : full.codigo);
                    }

                    return(btsActions);          
                }
                },{
                "targets" : 2,
                "render": function(data){                  
                  new_data = data.replace('fixo', ' Fixo').replace('ddd_', ' DDD para ').replace('ddd_', ' DDD para ').replace('ddi', ' DDI').replace('movel', ' Móvel');
                  
                 return new_data;
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
