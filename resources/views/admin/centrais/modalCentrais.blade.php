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
                 <form id='form_centrais' action='{{route('admin.centrais.store')}}' method='post'>
                 {{ csrf_field() }}

                 <div class='form-group' data-val='exigido'>
                        <label for='nome'> Nome</label> <input type='text' id='nome' name='nome' class='form-control' />
                 </div><br>

                 <div class='form-group'>
                   <div class='col-md-4'></div>
                   
                   <div class='col-md-4' >
                       <label for='filial' class='' style='float:left; margin-left: 10px' checked="checked"> <input id='filial' name='tipo' value='1' type='radio' class=''> Filial</label>
                       <label for='matriz' class='' style='float:right; margin-right:10px'> <input id='matriz' name='tipo' value='2' type='radio' class=''> Matriz</label>
                   </div>


                 </div> <br><br>

                 <div class='form-group' > 
                       <label for='codigo'> Código</label> <input type='text' placeholde='Entre 10 e 99' maxlength='2' id='codigo' name='codigo' class='form-control' />
                 </div><br>

                 <div class='form-group' data-val='exigido'>
                       <label for='codigo'> Tronco de saída</label> 
                       <select class='form-control' id='tronco' name='tronco' style='text-align:center'>
                            <option value="0">‹‹ selecione ››</option>
                            @foreach($troncos as $tronco)
                             <option value="{{$tronco->id}}"> {{$tronco->nome}} </option>
                            @endforeach
                       </select>
                 </div>

                 </form>         
                                      
        </center>        
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
       

      </form>

    </div>
  </div>
</div>