<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="groups-table">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Ações</th>
                        <th>Parent</th>
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

    var table = false;



    function clearSearchDatatable(){
        //clear last
        table.search('').columns().search('');
    }
    function searchDatatable(column, value){
        clearSearchDatatable();
        table.columns(column).search(value).draw();
    }

    $(function() {

        // provisório
        $('.masterSelect').find('option[value=15]').attr('disabled','disabled');

        $('#formSearchRamalSetting').submit(function(e){
            e.preventDefault();
            searchDatatable(3, $('.fieldTypes').val());
        });

        table = $('#groups-table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                "url": '{!! route('datatables.ramais.settings') !!}',
                "type": "GET",
                "data": function(d) {
                    console.log('ok');
                    console.log($('.fieldTypes').val());
                    d.columns[3].search.value = $('.fieldTypes').val();
                }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'status', name: 'status' },
                { data: 'parent_id', name: 'parent_id' }
            ],
            "columnDefs": [ {
                    "targets": 2,
                    "render": function ( data, type, full, meta ) {
                        var btsActions = '<a href="{{route('admin.ramais.settings.edit')}}/'+full.id+'" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                        btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse item?" href="{{route('admin.ramais.settings.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                        return btsActions;
                    }
                },
                { "visible": false, "orderable": false, "targets": 3, "searchable": true }
            ]
        });




    });
    </script>
@endpush
