<div class='row'>
	<h3>&nbsp Black list</h3>
	<div class='col-md-6'>
		<a href="" class="btn btn-block btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span> Adicionar Número</a><br> 
		<table id='blackListTable' class='table tgHardware troll-border sorting_1'>
		<thead>
		 	<td> Número </td>
		 	<td> Tronco </td>
		 	<td> Tipo de Bloqueio</td>
		</thead>
		</table>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalDefaultTitle"></h4>
      </div>
      <div class="modal-body" id="modalDefaultBody">
        <center>
                 <form id='formBlackList' action='{{route('admin.black_list.setNum')}}' method='post'>
                 {{ csrf_field() }}

                      <label for='numero'>Número</label>
                      <input type='text' id='numero' name='numero'>
                      <br>
                      <br>
                      <label for='num_tronco'>Troncos:</label>
                      <div id='num_tronco' class="well div_max_60">
                              @if( isset($troncos) )
							           	 @foreach ($troncos as $t)
							                  @if( array_search($t->id, array_column($troncosAdicionados['especiais'] == null ? $a = array() : $troncosAdicionados['especiais'], 'id')) === FALSE )	<!--//verifica se ele já foi adicionado.-->											                                 
							                  <div>
							                  <input type='checkbox' name='troncos[]' value='{{$t->id}}'/>
							                  {{$t->nome}}
							                  </div>
							                  <br>
							                  @endif
							           	 @endforeach
							  @endif  
                      </div>
                      <br>
                      <label for='saida'> Saída</label>
                      <input type='radio' name='tipo_bloqueio' value='1'>
                      <label for='saida'> Entrada</label>
                      <input type='radio' name='tipo_bloqueio' value='2'>
                      <label for='saida'> Bidirecional</label>
                      <input type='radio' name='tipo_bloqueio' value='0'>
                      
      </div>
      <div class="modal-footer">
           <div id='cadFooter'>
            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
            <input type="submit" id="submit" class="btn btn-primary" ></button>
           </div>
          
           <div id='editFooter'> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            <button type="button" id="edit" class="btn btn-primary">Salvar</button>
           </div>
      </div>
              </center>

      </form>

    </div>
  </div>
</div>

@push('scripts')
<script>
function resetaForm(){
	             console.log('resetando formulário...');   
	             $('#editFooter').hide();
	             $('#cadFooter').show();
	             
	             $('#myModal')
	                .find("input[type=text]")
	                   .val('')
	                   .removeAttr('disabled')
	                   .end()
	                .find("input[type=checkbox]")
	                   .prop('checked', false)
	                   .end()  
	                .find("input[type=radio]")
	                   .prop('checked', false)
	                   .end()
}
</script>
<script>

$(function(){
    $("#editFooter").hide();
    $('#myModal').on('hidden.bs.modal', function () {
         resetaForm();
    });

     table = $('#blackListTable').DataTable({
            processing: true,
            serverSide: true,
            info:false,
            "ajax": {
                'url': '{!! route('datatables.BlackList') !!}',
                'type': 'GET', 
            },
            columns: [
                { data: 'numero', name: 'numero'},
                { data: 'tronco', name:'tronco'},
                { data: 'tipo_bloqueio', name:'tipo_bloqueio'},
             ],
            "columnDefs": [ {
                  "targets":1,
                  "render": function(data){
                  	 console.log(data);
                  	 return data;
                  }  
            }]
        });

        $('#blackListTable_length').hide(); /*** REMOVE O CABEÇALHO INDESEJADO DA TABELA... SOLUÇÃO PROVISÓRIA***/

});
</script>
@endpush