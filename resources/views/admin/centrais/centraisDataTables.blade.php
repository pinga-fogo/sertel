<a href="" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Adicionar Central</a><br> 
		<table id='tabelas_centrais' class='table tgHardware troll-border sorting_1'>
  		<thead>
  		 	  <td> Nome </td>
  		  	<td> Tipo </td>
  		  	<td> Código</td>
          <td> Tronco de Saída </td>
          <td> Ações </td>
  		</thead>
      <tbody>
      </tbody>
		</table>


@push('scripts')


    <script>
    $(function(){   

      $('#tabelas_centrais').dataTable({
                processing: true,
                serverSide: true,
                ajax: '{!! route('datatables.centrais') !!}',
                columns: [
                    { data: 'nome', name: 'nome' },
                    { data: 'tipo', name: 'tipo' },
                    { data: 'codigo', name: 'codigo' },
                    { data: 'nome_tronco', name: 'nome_tronco' }
                ], columnDefs:[
                { 
                  "targets":4,
                  "render": function(data, meta, full){
                      var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                    
                    btsActions += "<a href='{{route('admin.centrais.destroy')}}/"+full.id+"/' data-id="+full.id+" data-action='confirm-delete' data-title='Exclusão' data-text='Deseja realmente deletar esse código?'"+full.numero+"' class='controlls-del' data-toggle='tooltip' title='Excluir'><i class='fa fa-times'></i></i></a>";


                    var json = JSON.stringify(full);
                   
                    sessionStorage.setItem(full.id, json);

                    return btsActions;
                  }
                

                },
                {
                  "targets":1,
                  "render": function(data){
                      if(data == undefined){
                        return;
                      }

                      switch(data){
                         case 1:
                              return 'Filial'; 
                         break;

                         case 2:
                              return 'Matriz';
                         break;
                         default:
                              return '?';
                         break;
                      }
                  }

                }
                ]
                
               
                 

            });

    });

  
    
    </script>

@endpush
