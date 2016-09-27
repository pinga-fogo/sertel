
<table id='tabelaGrupos' class='table'>
      <thead>
	      <th>Tipo</th>
	      <th>Número</th>
	      <th>Rota Direcional</th>
   	      <th>Ramais</th>
	      <th>Ações</th>   
   
      </thead>

      <tbody>
      </tbody>
</table>



@push('scripts')

<script>


$('#tabelaGrupos').DataTable({
	processing: true,
    serverSide: true,
	ajax: '{!! route('datatables.Grupos') !!}',
	columns: [
                { data: 'tipo', name: 'tipo' },
                { data: 'numero', name: 'numero' },
                { data: 'rota_dir', name: 'rota_dir' },
                { data: 'ramais', name: 'ramais' }

             ],           
    columnDefs: [
                	{
                       'targets':0,
                       'render': function(data){
                       		switch(data){
                       			case '1':
                       			return 'Hierárquico';
                       			break;

                       			case '2':
                       			return 'Distribuidor';
                       			break;

                       			case '3':
                       			return 'Múltiplo';
                       			break;
                       		}
                       		return data;
                       }

                	},
                	{
                       'targets':2,
                       'render': function(data){
                       		switch(data){
                       			
                       			case '1':
                       			return 'Entrada';
                       			break;

                       			case '2':
                       			return 'Saída';
                       			break;

                       			case '3':
                       			return 'Bidirecional';
                       			break;
                       		}
                       		return data;
                       }

                	},
                	{
                		'targets':3,
                		'render': function(data,meta, full){
                        //coloca um espaço depois das vírgulas
                        return full.nomesRamais.split(',').join(', ');
                    }
                	},
                	{
                		'targets':4,
                	    	"render": function(data, meta , full){
                          json = JSON.stringify(full);
                          sessionStorage.setItem(full.id, json);
                          
                          var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                          
                           btsActions += "<a href='{{route('admin.black_list.destroy')}}/"+full.id+"/' data-id="+full.id+" data-action='confirm-delete' data-title='Exclusão' data-text='Deseja realmente deletar esse número?'"+full.numero+"' class='controlls-del' data-toggle='tooltip' title='Excluir'><i class='fa fa-times'></i></i></a>";
                    
                    return(btsActions);
                		}
                	}
                ]     
});

</script>

@endpush