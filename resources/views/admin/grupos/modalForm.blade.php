
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <br>
                
        <div id='msgFeedBack' class='alert alert-danger hidden'>
             <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
             <ul id='listaerros'>
             
             </ul> 
        </div>
        <h4 class="modal-title" id="modalDefaultTitle"></h4>
      </div>
      <div class="modal-body" id="modalDefaultBody">
        <center>
                 <form id='form_grupos' action='{{route('admin.grupos.store')}}' method='post'>
                 {{ csrf_field() }}
           
           <input type='text' class='hidden' name='numeroAntigo' id='numeroAntigo'/>

      <div class="form-group" data-val='exigido'>
					<label for='tipo'>Tipo</label><br>
					<select id='tipo' class='form-control' name='tipo'>
						<option value='0'> ‹‹ selecione ›› </option>
            <option value='1'>Hierárquico</option>
						<option value='2'>Distribuidor</option>
						<option value='3'>Múltiplo</option>
					</select><br><br>
      </div>
					

      <div class="form-group" data-val='exigido'>
          <label for='numero'>Número grupo</label><br>
					<input type='text' placeholder='Digite o nº do grupo' class='form-control' name='numero' id='numero' maxlength='5'/><br><br>
      </div>

      <div class="form-group" data-val='exigido'>
					<label for='rota_dir'>Rota Direcional</label><br>
					<select id='rota_dir' class='form-control' name='rota_dir'>
  						<option value='0'> ‹‹ selecione ›› </option>
              <option value='1'>Saída</option>
  						<option value='2'>Entrada</option>
  						<option value='3'>Bidirecional</option>
					</select><br><br>
      </div>

      <div class="form-group" data-val='exigido'>
					<label for='ramais'>Ramais</label><br>
					<select style="max-heigth:40px" id='ramais' class='form-control' multiple='multiple' name='ramais[]'>
					</select><br><br>
      </div>

      <div class="form-group" data-val='exigido'>
					<label for='correio_de_voz'>Correio de Voz</label><br>
					<input type='checkbox' class='switch' value='1' name='correio_de_voz' id='correio_de_voz'><br><br>
      </div>
     
      <div class="form-group" data-val='exigido' id='div_email'>
						<label for='email'>Email</label><br>
						<input type='email' class='form-control'  id='email' name='email'/> <br>         
      </div>
      
          <div class="form-group" data-val='exigido'>
					<label for='tempo_chamada'>Tempo de chamada no grupo</label><br>
					<select id='tempo_chamada' class='form-control' name='tempo_chamada'>
						<option value='0'> ‹‹ selecione ›› </option>
            <option value=10>10</option>
						<option value=15>15</option>
						<option value=20>20</option>
						<option value=25>25</option>
						<option value=30>30</option>
						<option value=40>40</option>
						<option value=60>60</option>
					</select><br><br>
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



