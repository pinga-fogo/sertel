<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
        <div id="div_lista_erros" class="alert alert-danger">
         <ul id="lista_erros">
         </ul>
        </div>
        <h4 class="modal-title" id="modalDefaultTitle"></h4>
      </div>
      <div class="modal-body" id="modalDefaultBody">
        <center>
          <form id='formBlackList' action='{{route('admin.black_list.setNum')}}' method='post'>
                 {{ csrf_field() }}

                      <label for='numero'>Número</label>
                      <input type='text' id='numero' class='form-control' maxlength='20' name='numero' required>
                      <input type='text' id='numeroAntigo' class='hidden'>
                      <br>
                      <br>
                      <label for='num_tronco'>Troncos:</label>
                      <div id='num_tronco' class="well div_max_60">
                             <div class="btn-group btn-group-sm {{$troncos? '' : 'hidden'}}" role="group" aria-label="">
                                 <button type="button" id='selectAll' class="btn btn-default">Marcar todos</button>
                                  <button type="button" id='deSelectAll'class="btn btn-default">Desmarcar todos</button>
                             </div>
                             <br>
                             <br>

                              @if($troncos)
                              <table class=''> 

                                   @foreach ($troncos as $t)                                                       
                                        <tr>
                                        <td style='padding:10px'><input type='checkbox' name='troncos[]' value='{{$t->id}}'/></td>
                                        <td style='padding:10px'>{{$t->nome}}</td>
                                        </tr>
                                     
                                   @endforeach
                              </table>  
                              @else 
                               <br><div id='div_empty_error'><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i>
                                    <p class='text-danger'>Nenhum Tronco Cadastrado</p>
                                    <p class='text-danger'>Clique <a href='{{route('admin.troncos.index')}}'>AQUI</a> para Adicionar um.</p>
                                    </div>
                                <br>
                              @endif
                    </div>

                    </div>
                    <br>
                    <center>
                    <label for='num_tronco'>Tipo de bloqueio:</label>
                    
                    <div id='num_bloqueio'>
                    <span> Saída</span>
                    <input id='saida' type='radio' name='tipo_bloqueio' value='1'>
                    <span> Entrada</span>
                    <input id='entrada'type='radio' name='tipo_bloqueio' value='2'>
                    <span> Bidirecional</span>
                    <input id='bidirecional' type='radio' name='tipo_bloqueio' value='0'>
                    </div>
                    <br>
                    <br>
                    </center>

                   
      <div class="modal-footer">
             <div id='cadFooter'>
              <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
              <button type="button" id="enviar" class="btn btn-primary">Cadastrar</button>
             </div>
            
             <div id='editFooter'> 
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" id="edit" class="btn btn-primary">Salvar</button>
             </div>
      </div>
     </form>
    </center>

    </div>
  </div>
</div>