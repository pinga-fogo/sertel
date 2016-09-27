<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="groups-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Total de Usuários</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
@push('scripts')
    <script>
    $(function() {
        $('#groups-table').dataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                'url': '{!! route('datatables.groups') !!}',
                'type': 'GET',
                'data': function(d) {
					d.columns[2].search.value = 1;
				}
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'count_users', name: 'count_users' },
                { data: 'status', name: 'status' }
            ],
            "columnDefs": [ {
                "targets": 3,
                "render": function ( data, type, full, meta ) {
                  var btsActions = '<a href="{{route('admin.groups.edit')}}/'+full.id+'" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                  if(full.count_users<1){
                      btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse grupo?" href="{{route('admin.groups.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                  }else{
                      btsActions += '<a data-title="Ação negada" class="controlls-del" data-toggle="tooltip" title="Ação negada"><i class="fa fa-times"></i></i></a>';
                  }
                  return btsActions;
                }
              }]
        });
    });
    </script>
@endpush
