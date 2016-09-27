<!-- Page Heading -->
<div class="col-lg-12">
            <table class="table"  style='width:100%' id="table">  
                <thead class="">
                        <th>Nome</th>
                        <th>Juntor</th>
                        <th>Fabricante</th>
                        <th>Ações</th>
                </thead>
                <tbody>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                </tbody>
            </table>
</div>
@push('scripts')
    <script>
    var table = '';
    
    $(function() {        
        sessionStorage.clear();
        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                'url': '{!! route('datatables.juntor') !!}',
                'type': 'GET', 
            },
            columns: [
                { data: 'nome', name: 'nome'},
                { data: 'juntor', name:'juntor'},
                { data: 'fabricante', name:'fabricante'},
             ],
            "columnDefs": [ {
                    "targets":2,
                    "render": function (data){                 
                          switch(data){
                             case '11':
                             return('KHOMP');
                             break;
                             case '12':
                              return('Intelbras'); 
                             break;
                             case '13':
                             return('Digium');
                             break;
                             case '14':
                             return('Digivoice'); 
                             break;
                             case '15':
                             return('Sangoma');
                             break;
                             case '16':
                             return('Dahdi'); 
                             break;
                             default:
                             return ('?');
                             break;
                          }         
                    }  
            },{
                    "targets":3,
                    "render": function ( data, meta, full, type) {
                        var btsActions = '<a href="{{route('admin.juntor.edit')}}/'+full.id+'/'+full.fabricante+'" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                      //  if(full.count_users<1){
                            btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse juntor?'+full.nome+'" href="{{ route('admin.juntor.destroy') }}/'+full.nome+'/'+full.fabricante+'" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                       // }else{
                          //  btsActions += '<a data-title="Ação negada" class="controlls-del" data-toggle="tooltip" title="Ação negada"><i class="fa fa-times"></i></i></a>';
                      //  }
                       json = JSON.stringify(full);
                       sessionStorage.setItem(full.id, json);
                       return btsActions;
                    }
                },{ "targets":0,
                'render': function (data){                      
                      var vetorNomes = sessionStorage.getItem('nomesJuntores') != undefined ? sessionStorage.getItem('nomesJuntores').split(',') : '';
                      
                      if(vetorNomes.indexOf(data) == -1){ 
                      sessionStorage.setItem('nomesJuntores', sessionStorage.getItem('nomesJuntores') != undefined ? sessionStorage.getItem('nomesJuntores')+','+data : data);
                      }
                      return data;
                }
            }
                ]
        });
    });
    $('#table').removeClass('dataTable');

    </script>
@endpush
