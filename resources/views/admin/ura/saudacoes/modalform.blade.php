<div class="modal fade" id="saudacoesModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" style="width:60%" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button><br><br>
              <h4 class="modal-title" id="modalDefaultTitle"></h4>
              
              <div id='msgFeedBack' class='alert alert-danger hidden'>
                   <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                   <ul id='listaerros'>
                   </ul> 
              </div>
             
            </div>
            {{ Form::open(array('method' => 'post', 'route' => 'admin.saudacoes.update', 'id' => 'formSaudacoes')) }}

              <div class="modal-body" id="modalDefaultBody">
                     @include('admin/ura/saudacoes/formfields')  
              </div>
              
              <div class="modal-footer">
                
                  
                   <div id='editFooter'> 
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="saudacoes_enviar" class="btn btn-primary">Salvar</button>
                   </div>
              </div>
              
            {{ Form::close() }}

            </form>
              
                </div>
              </div>
        </div>
     </div>        
  