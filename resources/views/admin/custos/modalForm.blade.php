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
                 <form id='form_custos' action='{{route('admin.custos.store')}}' method='post'>
                 {{ csrf_field() }}

                 <label for='nome'>Nome:</label><br><input type='text' class='form-control' name='nome' id='nome'/><br>
                 <label for='nome'>Valor do Crédito:</label><br><input type='text'  class='form-control' name='cred_valor' id='cred_valor'/> <br>  
                 
                 <label for='recarga'>Recarga Mensal</label><br>
                 <input type="checkbox" value="1" class='switch' name='recarga_mensal'/><br>
                <br>
                <label for='div_ramais'>Ramais: </label>
                 <div class='well div_max_60' id='div_ramais'>
                        <table>
                        
                        @foreach ($todos_ramais as $ramal)
                           <tr><td  style="padding:10px; padding-right:20px"><input type='checkbox' value='{{$ramal->id}}' name='ramais[]' /></td><td style="padding:10px; padding-right:20px">{{$ramal->nome}}</td></tr>
                        @endforeach
                        
                        </table>
                        <input type='text' id='ramaisAntigos' name='ramaisAntigos' class='hidden'>
                 </div>         
                     
      </div>
      <div class="modal-footer">
           <div id='cadFooter'>
            <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
            <button type="button" id="enviar" class="btn btn-primary">Cadastrar</input>
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