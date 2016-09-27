@extends('admin.base')
@section('content')

<table id='tabela_ligacoes' class='table'>
 <thead>
   <th>Data/Hora</th>
   
   <th>Origem</th>

   <th>Destino</th>

   <th>Tipo</th>

   <th>Transferência</th>

   <th>Categoria</th>

   <th>Duração</th>

   <th>Status</th>

   <th>Nome</th>

   <th>Valor</th>
									
 </thead>
 <tbody>
    
</tbody>

</table>

@endsection
@push('scripts')
<script>

$('#tabela_ligacoes').dataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.cdr') !!}',
            columns: [
                { data: 'calldate', name: 'calldate' },
                { data: 'src', name: 'src'},
                { data: 'dst', name: 'dst'},
                { data: 'tipo', name: 'tipo'},
                { data: 'transferencia', name: 'transferencia' },
                { data: 'categoria', name: 'categoria' },
                { data: 'duracao', name: 'duracao' },
                { data: 'disposition', name: 'disposition' },
                { data: 'nome', name: 'nome' },
                { data: 'valor', name: 'nome' }
            ],
            "columnDefs": [ {
                "targets": 0,
                "render": function ( data, type, full, meta ) {
                  // var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit " data-id="'+full.id+'"data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                  // btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse ramal?" href="{{route('admin.ramais.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                  // console.log('destruir');
                  // var json = JSON.stringify(full);
                  // sessionStorage.setItem(full.id, json);
                  // $('#nomesStringbuffer').val( $('#nomesStringbuffer').val() + ';' + full.nome);
                  // return btsActions;

                  return data == '' ? '-' : data;
                }
              },{
              "targets": 1,
              "render": function (data) {

              return data == '' ? '-' : data;
              }
             },{
              "targets": 2,
              "render": function (data) {

              return data == '' ? '-' : data;
              }
             },{
              "targets": 3,
              "render": function (data) {
          
              return data == '' ? '-' : data;
              }
             },{
              "targets": 4,
              "render": function (data) {
          		
              return '-';
              }
             },{
              "targets": 5,
              "render": function (data) {
          
              return '-';
              }
             },{
              "targets": 6,
              "render": function (data, type, full, meta) {
              
              var inicio = new Date(full.start);
              var fim = new Date(full.end);
              var duracao = new Date(fim-inicio);

				var dateString =	
				  ("0" + duracao.getUTCHours()).slice(-2) + ":" +
				  ("0" + duracao.getUTCMinutes()).slice(-2) + ":" +
				  ("0" + duracao.getUTCSeconds()).slice(-2);

              return dateString;
              }
             },{
              "targets": 7,
              "render": function (data) {
              
              switch(data){
              	case 'NO ANSWER' : 
              		return 'Não Atendida';
              	break;
              	case 'ANSWERED':
              		return 'Atendida';
              	break;
              	case 'BUSY':
              		return 'Ocupada';
              	break;
              	case 'CONGESTED':
              		return 'Congestionado';
              	break;		
              }

              return data == '' ? '-' : data;
              }
             },{
              "targets": 8,
              "render": function (data) {
          	    
          	   return data == '' ? '-' : data; 
              }
             },{
              "targets": 9,
              "render": function (data) {
          
               return '-'; 
              }
             }
              ]
        });

</script>
@endpush