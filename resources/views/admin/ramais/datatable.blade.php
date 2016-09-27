<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="groups-table" attr-sample='thetable'>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Ramal</th>
                        <th>Aplicação</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>
<input type='text' id='nomesStringbuffer' class='hidden'/>
@push('scripts')
          
    <script>
    $(function() {
         JSON.stringify = JSON.stringify || function (obj) {
            var t = typeof (obj);
            if (t != "object" || obj === null) {
                // simple data type
                if (t == "string") obj = '"'+obj+'"';
                return String(obj);
            }
            else {
                // recurse array or object
                var n, v, json = [], arr = (obj && obj.constructor == Array);
                for (n in obj) {
                    v = obj[n]; t = typeof(v);
                    if (t == "string") v = '"'+v+'"';
                    else if (t == "object" && v !== null) v = JSON.stringify(v);
                    json.push((arr ? "" : '"' + n + '":') + String(v));
                }
                return (arr ? '[' : '{') + String(json) + (arr ? "]" : "}");
            }
        };

     $('#groups-table').dataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('datatables.ramais') !!}',
            columns: [
                { data: 'nome', name: 'nome' },
                { data: 'numero', name: 'numero' },
                { data: 'aplicacao', name: 'aplicacao' },
                { data: 'status', name: 'status' }
            ],
            
            "columnDefs": [ {
                "targets": 3,
                "render": function ( data, type, full, meta ) {
                  var btsActions = '<a href="javascript:showEdit('+full.id+')" class="controlls-edit " data-id="'+full.id+'"data-toggle="tooltip" title="Editar"><i class="fa fa-pencil-square-o"></i></a>';
                  btsActions += '<a data-id="'+full.id+'" data-action="confirm-delete" data-title="Exclusão" data-text="Deseja realmente deletar esse ramal?" href="{{route('admin.ramais.destroy')}}" class="controlls-del" data-toggle="tooltip" title="Excluir"><i class="fa fa-times"></i></i></a>';
                  console.log('destruir');
                  var json = JSON.stringify(full);
                  sessionStorage.setItem(full.id, json);
                  $('#nomesStringbuffer').val( $('#nomesStringbuffer').val() + ';' + full.nome);
                  return btsActions;
                }
              },{
              "targets": 2,
              "render": function (data, type, full) {

               var app;
             
               switch(data){
                case  111 : 
                app = 'PABX';
                break;
                case 112 : 
                app = 'DAC';
                break;
          
                case 113 : 
                app = 'URA';
                break;
              
                case 114: 
                app = 'DISA';
                break;
            
                case 115 : 
                app = 'FAX';
                break;

                case 116 : 
                app = 'PORTEIRO';
                break;

                default:
                app = '?'
                break;
              }
              return app;
              }
             }
              ]

        });
    
    });
    </script>
    
@endpush
