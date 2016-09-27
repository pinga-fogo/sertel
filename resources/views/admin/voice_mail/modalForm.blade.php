<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
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
            <!-- <form id='formVoiceMail' method='get' action='{{route("admin.voice_mail.store")}}'> -->
            {{ Form::open(array('method' => 'get', 'route' => 'admin.voice_mail.store', 'id' => 'formVoiceMail')) }}

            
              <div class="modal-body" id="modalDefaultBody">
                     <!--{!! Form::open( array('method'=>'get', 'data-toggle'=>'validator', 'id'=>'formRamal') ) !!} -->
                     @include('admin/voice_mail/formfields')  
              </div>
              
              <div class="modal-footer">
                   <div id='cadFooter'>
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
                    <button type="button" id="enviar" class="btn btn-primary" >Cadastrar</button>
                   </div>
                  
                   <div id='editFooter'> 
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="editar" class="btn btn-primary">Salvar</button>
                   </div>
              </div>
             {{ Form::close() }}

            </form>
              
                </div>
              </div>
        </div>
     </div>        
  