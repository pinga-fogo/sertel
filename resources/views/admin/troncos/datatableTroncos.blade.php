<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="display table tgHardware troll-border sorting_1" id="table">  
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Tecnologia</th>
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
    var table = '';

    $(function() {

        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            paging:false,
            "ajax": {
                'url': '{!! route('datatables.troncos') !!}',
                'type': 'GET',
                'data': function(d) {
                    //d.columns[3].search.value = 1;
                }
            },
            columns: [
                //{ data: 'id', name: 'id' },
                { data: 'nome', name: 'nome' },
                { data: 'tecnologia', name: 'tecnologia' },
                //{ data: 'status', name: 'status' }
            ],
            
            "columnDefs": [{
                    "targets":1,
                    "render": function(data, type, full){
                         switch(data){
                            case '11': 
                            return 'IP';
                            break;
                            case '12': 
                            return 'GSM';
                            break;
                            case '13': 
                            return 'Digital';
                            break;
                            case '14': 
                            return 'Analógico';
                            break;
                            case '15': 
                            return 'Legado';
                           break;
                            default:
                            return(data);
                            break;
                         }
                    }
                    },{
                    "targets":2,
                    "render": function ( data, type, full, meta ) {
                        var btsActions = '<a href=javascript:showEdit("'+full.id+'") class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                            btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse grupo?" href="{{route('admin.troncos.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                        var json = JSON.stringify(full); 
                        sessionStorage.setItem(full.id, json);
                        return btsActions;
                    }
                    }]
        });

       
     });
     
    </script>
@endpush
