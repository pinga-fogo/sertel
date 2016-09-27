<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="groups-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        
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
                'url': '{!! route('datatables.uras') !!}',
                'type': 'GET',
            },
            columns: [
                { data: 'nome_ramal', name: 'nome_ramal' },

            ]
            ,
            "columnDefs": [{
                "targets": 1,
                "render": function ( data, type, full, meta ) {
                  json = JSON.stringify(full);
                  sessionStorage.setItem(full.id, json);
                  
                   var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';

                      btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse grupo?" href="{{route('admin.uras.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                  
                  return btsActions;
                }
            }]
        });
    });
    </script>
@endpush
