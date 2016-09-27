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
                 <form id='form_codigos' action='{{route('admin.codigos.store')}}' method='post'>
                 {{ csrf_field() }}

                          <label for='cod_conta'> Código:</label><input class='form-control' id='cod_conta' type='text' name='cod_conta'/> <br>
                          <input type='text' value='' name='codigoAntigo' id='codigoAntigo' class='hidden'>

                          <label for='nome'> Nome:</label> <input class='form-control' id='nome' type='text' name='nome'/> <br>

                          <label for='senha'> Senha:</label> <input class='form-control' type='password' id='senha' name='senha'/> <br>
                          
                          <div id='div_conf_senha'>
                          <label for='conf_senha'> Confirmar Senha: </label> <input class='form-control' id='conf_senha' type='password' name='conf_senha'/>
                          <br>
                          </div>

                          <label for='tipo_bloqueio'> Bloqueios: </label> 
                          <br>
                   <table id ='tipo_bloqueio'>   
                    <tr>
                        <td>
                        <div id='bloqueios'>
                           <label for='fixo'> <input type='checkbox' id='fixo' value='fixo' name='bloqueios[]'/> Fixo </label><br>
                           <label for='movel'> <input type='checkbox' id='movel' value='movel' name='bloqueios[]'/> Móvel </label><br>
                           <label for='ddd_fixo'>  <input type='checkbox' value='ddd_fixo' id='ddd_fixo' name='bloqueios[]'/> DDD para fixo</label><br>
                           <label for='ddd_movel'>  <input type='checkbox' value='ddd_movel' id='ddd_movel' name='bloqueios[]'/> DDD para móvel </label><br>
                           <label for='ddi'>  <input type='checkbox' id='ddi' value='ddi' name='bloqueios[]'/> DDI</label><br>
                        </td>
                        </div>
                    </tr>
                  </table>
          
                                      
                     
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