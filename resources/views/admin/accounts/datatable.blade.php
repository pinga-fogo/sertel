<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="users-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
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
        $('#users-table').dataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.users') !!}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'lastname', name: 'lastname' },
                { data: 'email', name: 'email' },
                { data: 'id', name: 'id' },
                // { data: 'created_at', name: 'created_at' },
                // { data: 'updated_at', name: 'updated_at' }
            ],
            "columnDefs": [ {
                "targets": 4,
                "render": function ( data, type, full, meta ) {
                  var btsActions = '<a href="{{route('admin.accounts.edit')}}/'+full.id+'" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                  btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse usuário?" href="{{route('admin.accounts.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                  return btsActions;
                }
              }]
        });
    });
    </script>
@endpush
