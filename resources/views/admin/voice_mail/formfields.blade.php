<center>

<div data-val='exigido'><label for='nome' >Nome</label><br><input  maxlength="20" type='text' class='form-control' name='nome' id='nome'/><br></div>
<div data-val='exigido'><label for='de'>De</label><br><input type='text' maxlength="40" class='form-control' placeholder='*Opcional*'  name='de' id='de'/> </div><br>  
<label for='para'>Para</label><br><input maxlength="40" type='text'  class='form-control' name='para' id='para'/><br>  

<div data-val='exigido'>
<label for='ramal'>Ramal</label><br>
<select class='form-control' id='ramal' name='ramal'> 
<option value='0'>‹‹ selecione ››</option> 
</select> <br> <br>
</div> 

<label for='habilitado'>Habilitado</label><br>
<input type="checkbox" value="1"  class='switch' name='habilitado' id='habilitado'/><br><br>

<label for='senha'>Senha</label><br><input maxlength="10" type='text'  class='form-control' name='senha' id='senha'/><br>  
<input type='text' value='' class='hidden' name='mensagem'>

<div class="mensagem" id='editor'></div>
<!-- <label for='recarga'>Mensagem</label><br>
<textarea id='mensagem' maxlength="140" name='mensagem' class=''>  </textarea> -->
</div>
        
</center>