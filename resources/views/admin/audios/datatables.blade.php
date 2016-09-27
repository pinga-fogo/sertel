<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped tabelaCentralizada" id="audios-table">
                <thead>
                    <tr>
                        <th style='text-align:center'>Nome</th>
                        <th style='text-align:center'>Ouvir</th>
                        <th style='text-align:center'>Ações</th>
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
        $('#audios-table').dataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                'url': '{!! route('datatables.audios') !!}',
                'type': 'GET',
                
            },
            columns: [
                { data: 'nome', name: 'nome' },
            ],
            "columnDefs": [{
                "targets": 2,
                "render": function ( data, type, full, meta ) {
                  json = JSON.stringify(full);
                  sessionStorage.setItem(full.id, json);
                  
                  // var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';

                      btsActions = '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse grupo?" href="{{route('admin.audios.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                  
                  return btsActions;
                }
              }, {
                "targets": 1,
                "render": function(data, type, full){
                    btnOuvir = '<audio controls> <source src="/assets/audios/'+full.nome+'.wav" type="audio/wav"> Seu navegador não é compatível com Player</audio>';

                    return btnOuvir;
                }

              }]
        });
    });
    </script>
@endpush
