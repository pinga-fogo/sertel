<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="display table table-hover" id="table">  
            <!-- <table class="table table-bordered table-hover table-striped" id="table">-->
                <thead>
                    <tr>
                   <!--     <th>Id</th> -->
                        <th>Nome</th>
                     <!--   <th>Default</th> -->
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

        table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                'url': '{!! route('datatables.profiles_ramais') !!}',
                'type': 'GET',
                'data': function(d) {
                    //d.columns[3].search.value = 1;
                }
            },
            columns: [
                //{ data: 'id', name: 'id' },
                { data: 'nome', name: 'nome' },
                //{ data: 'default', name: 'default' },
                { data: 'status', name: 'status' }
            ],
            
           /* "columnDefs": [ {
                "targets":2,
                "render": function ( data, type, full, meta ) {
                    var btsActions = '';
                    console.log(full.default);
                    
                    if(full.default==1){
                        btsActions =  '<a href="#" class="controlls-edit check-default" data-key="'+full.id+'" data-toggle="tooltip" title="Marcado como default"><i class="glyphicon glyphicon-ok"></i></a>';
                    }else{
                        btsActions = '<a href="#" class="controlls-edit check-default" data-key="'+full.id+'" data-toggle="tooltip" title="Marcar como default"><i class="glyphicon glyphicon-unchecked"></i></a>';
                    }

                    return btsActions;
                }
            }, */
            "columnDefs": [{
                    "targets":1,
                    "render": function ( data, type, full, meta ) {  
                        
                        if(full.dependentes.length !== 0){
                          var dependentes = full.dependentes.split(';');
                          console.log('dependentes'+ dependentes);
                          var msg_dependencia = 'Este perfil esta sendo usado pelo(s) ramal(s): &#10;';
                          for (var i=1 ; i<dependentes.length ; i++){
                            msg_dependencia += ("&#34;"+dependentes[i]+'&#34;'+' ');
                          }
                        } else {
                           console.log('sem dependencia');
                            msg_dependencia = '';
                        }

                        var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit" data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                      //  if(full.count_users<1){
                            
                         btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Atenção" data-text="'+msg_dependencia+'Deseja realmente deletar esse grupo?" href="{{route('admin.profiles_ramais.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                        
                        json = JSON.stringify(full);
                        sessionStorage.setItem(full.id, json);
                        $('#nomesStringbuffer').val( $('#nomesStringbuffer').val() + ';' + full.nome);

                       // }else{
                          //  btsActions += '<a data-title="Ação negada" class="controlls-del" data-toggle="tooltip" title="Ação negada"><i class="fa fa-times"></i></i></a>';
                      //  }
                        return btsActions;
                    }
                }]
        });

       /* $('#table').on('click', '.check-default', function(e){
            e.preventDefault();
            $.get('{!! route('admin.profiles_ramais.set_default') !!}', {id: $(this).data('key')}, function(data){
                if(data.status){
                    table.draw();
                }
            },'json');

        }); */
    }); 
     
     /*
      table = $('#table').DataTable({
            processing: true,
            serverSide: true,
            "ajax": {
                'url': '{!! route('datatables.profiles_ramais') !!}',
                'type': 'GET',
                'data': function(d) {
                    d.columns[3].search.value = 1;
                } 
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'default', name: 'default' },
                { data: 'status', name: 'status' }
            ],          
            "columnDefs" : [{
            "targets" : 2,
            "data" : null,
            "defaultContent" : "<button> Clique </ button>"
            }]
        }); */

    </script>
@endpush
