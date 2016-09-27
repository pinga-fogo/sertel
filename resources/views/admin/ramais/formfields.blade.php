

<center>

<div class="form-group " >
              <!--{{ Form::label('ddr', 'Nº DDR') }}-->
              {{ Form::text('antigos', null, ['placeholder'=>'', 'class'=>'hidden', ]) }} <!-- DDR -->
</div>
<div class="form-group " >
              <!--{{ Form::label('ddr', 'Nº DDR') }}-->
              {{ Form::text('id', null, ['placeholder'=>'', 'class'=>'hidden', ]) }} <!-- DDR -->
</div>

<div class="" data-val='exigido'> <!-- MASTER_ID -->
        {{ Form::label('tipo', 'Tipo' ) }}
        {{ Form::select('tipo',
         [
         0 => '‹‹ selecione ››',
         1 => 'Tronco',
         39 => 'User'
         ]
        , null, ['class'=>'form-control ', 'data-default'=>'']) }} 
</div>


<div class="form-group aplicacao" data-val='exigido'>
        {{ Form::label('app', 'Aplicação') }}
        {{ Form::select('app',
         [
         0 => '‹‹ selecione ››',
         111 => 'PABX',
         112 => 'DAC',
         113 => 'URA',
         114 => 'DISA',
         115 => 'FAX',
         116 => 'PORTEIRO'
         ]
        , null, ['class'=>'form-control ', 'data-default'=>'' ]) }}  <!-- APLICAÇÃO -->
</div>

<div class="form-group" data-val='exigido'>
        {{ Form::label('tec', 'Tecnologia') }}
        {{ Form::select('tec',
         [
         0 => '‹‹ selecione ››',
         12 => 'SIP',
         13 => 'IAX',
         14 => 'SIP & IAX',
         15 => 'FXS',
         16 => 'PBX-LEGADO'
         ]
        , null, ['class'=>'form-control ', 'data-default'=>'']) }}   <!-- MASTER_ID --><!-- TECNOLOGIA -->
</div>

<div class="form-group" id='centrais' data-val='exigido'>
        {{ Form::label('central', 'Central') }}
        {{ Form::select('central',
         [
         0 => '‹‹ selecione ››',
         ]
        , null, ['class'=>'form-control ', 'data-default'=>'']) }} 
</div>

<div class="nat form-group">
        {{ Form::label('nat', 'NAT') }}
        <br>
        {{ Form::checkbox('nat', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
</div>

<div class='porta form-group'>
        {{ Form::label('porta', 'Porta') }}
        {{ Form::text('porta', null, ['class'=>'form-control', 'placeholder'=>'Digite a porta']) }} <!-- DDR -->
</div>

<div class="form-group profile"> <!-- MASTER_ID -->
        {{ Form::label('profile', 'Perfil') }}
        {{ Form::select('profile',
         [
         0 => 'Nenhum Perfil Criado',
         ]
        , null, ['class'=>'form-control ', 'data-default'=>'']) }} 
</div>

<div id='fila' class="form-group form_dac"> <!-- MASTER_ID -->
        {{ Form::label('fila', 'Fila', ['class'=>'']) }}
        {{ Form::select('fila',
         [
         0 => 'Nenhuma',
         ]
        , null, ['class'=>'form-control ', 'data-default'=>'']) }} 
</div>

<div class="form-group">
    {{ Form::label('number', 'Nº ramal') }}
    {{ Form::text('number', null, ['placeholder'=>'Digite Nº ramal', 'class'=>'form-control']) }}
        <!-- NÚMERO DO RAMAL -->
</div>


<div class="form-group" >
    {{ Form::label('nome', 'Nome de identificação') }}
    {{ Form::text('nome', null, ['placeholder'=>'Digite o Nome de identificação', 'class'=>'form-control', 'maxlength'=>'19']) }} <!-- NÚMERO DO RAMAL -->
</div>
     
{{ Form::label('password', 'Senha', array('class'=>'senha_field')) }}
<div class="form-group senha_field" id='senha'>
      
   <div class="input-group col-xs-6 col-md-4" >
       <span class="input-group-addon" id="basic-addon1" ><a href='javascript:gerarAleatorio()'><i class="fa fa-random" aria-hidden="true"></i></a>
       </span>
       <input type="text" name='password' id='password' maxlength='10' class="form-control " placeholder="Digite a Senha" aria-describedby="basic-addon1"/>
    </div>

</div>
 

 <div class="form_pabx form-group habDDR">
         {{ Form::label('habDDR', 'Habilitar DDR') }}<br>
    <div class="col-lg-6 inputCenterModal">
    <div class="input-group">
          <span class="input-group-addon" >
                {{ Form::checkbox('habDDR', '1', false, ['class'=>'switch', 'data-default'=>'1','data-size'=>'mini']) }}
          </span>
          <div class="form-group num_ddr" data-val='exigido'>
              <!--{{ Form::label('ddr', 'Nº DDR') }}-->
              {{ Form::text('ddr', null, ['placeholder'=>'Nº', 'class'=>'form-control tamDDR ', ]) }} <!-- DDR -->
          </div>
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 --> 
 <br> 
</div> 
<br>
<br>

<fieldset class="form_din form_pabx" id="fieldsetfac">
    <legend>Facilidades do ramal</legend>

    <div class="form-group form_din form_pabx">
        {{ Form::label('deviation', 'Desvio') }}
        {{ Form::select('deviation',
        [
         0 => 'Nenhum',
         1 => 'Não atende',
         2 => 'Ocupado',
         3 => 'Sempre',
         4 => 'Sem registro',
         5 => 'Ocupado/ñ atende/ñ registrado'
            ]
        , null, ['class'=>'form-control ', 'data-default'=>'']) }}<!-- DESVIO -->
    </div> 
    
     <div class="form-group detour" data-val='exigido'>
        {{ Form::label('detour', 'Desvio para') }}
        {{ Form::select('detour',
         [
         0 => '‹‹ selecione ››',
         1 => 'lista dos grupos de atendimentos',
         2 => 'correio de voz',
         3 => 'numero externo'
            ]
        , null, ['class'=>'form-control ', 'data-default'=>'']) }} <!-- DESVIO PARA -->
    </div>



    <div id='noexterno' class="noexterno" data-val='exigido'>
    {{ Form::label('no_externo', 'Nº Externo') }}
    {{ Form::text('no_externo', null, ['placeholder'=>'Digite o Nome de identificação', 'class'=>'form-control']) }} <!-- NÚMERO DO RAMAL -->
    </div>


    <div class="form_group form_din form_pabx">
        <div class="row m20">
            <div class="col-lg-4">
                {{ Form::label('notdisturb', 'Não pertube') }}
                <br>
                {{ Form::checkbox('notdisturb', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
            </div>
            <div class="col-lg-4">
                {{ Form::label('conference', 'Conferência') }}
                <br>
                {{ Form::checkbox('conference', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
            </div>
            <div class="col-lg-4">
                {{ Form::label('accountcode', 'Código de conta') }}
                <br>
                {{ Form::checkbox('accountcode', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
            </div>
        </div> 
        <div class="row m20">
            <div class="col-lg-4" class="fac">
                {{ Form::label('centercost', 'Centro de custo') }}
                <br>
                {{ Form::checkbox('centercost', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
            </div>
            <div class="col-lg-4">
                {{ Form::label('intercomaccess', 'Acesso porteiro') }}
                <br>
                {{ Form::checkbox('intercomaccess', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
            </div>
            
            <div class="form-group col-lg-4 form_din form_pabx"> 
            {{ Form::label('capture', 'Permite ramal ser capturado') }}
            <br>
            {{ Form::checkbox('capture', '1', true, ['class'=>'switch', 'data-default'=>'1']) }}
            </div>
      </div>
     <div class='row m20'>
            <div class="form-group col-lg-4 form_din form_pabx"> 
                {{ Form::label('parking_calls', 'Permite estacionar chamadas') }}
                <br>
                {{ Form::checkbox('parking_calls', '1', true, ['class'=>'switch', 'data-default'=>'1']) }}
            </div>
    </div>
</center>

    </div>
</fieldset>
<br>
<br>
@push('scripts')

<script>
    Array.prototype.shuffle = function() {
    var input = this;
     
    for (var i = input.length-1; i >=0; i--) {
     
        var randomIndex = Math.floor(Math.random()*(i+1)); 
        var itemAtIndex = input[randomIndex]; 
         
        input[randomIndex] = input[i]; 
        input[i] = itemAtIndex;
    }
    return input;
    }

    function gerarAleatorio(){
       array_letras = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
       
       num ='';
       letras ='';

       min = 1000;
       max = 9999;
       
       for(var i = 0  ; i < 2 ; i++){
          letras += array_letras[Math.floor(Math.random() * array_letras.length )];
       }
       
       num = Math.floor(Math.random() * (max - min) + min);       
       senha = num+letras;
       senha = senha.split('').shuffle().join('');
       senha = 
       $('input[name=password]').val(senha);
    }


    function showEdit(id){
                      $('#formRamais').attr('action', '{{route("admin.ramais.update")}}/'+id) ;
                      console.log('showEdit()');
                      json = sessionStorage.getItem(id);
     
                      json = JSON.parse(json);
                      
                      $('#cadFooter').hide(),      
                      $('#editFooter').show();
                      console.log(json.profile_ramal_id);
                                 $('input[name=antigos]').val(json.nome+';'+json.numero);                              
                                 $('#tipo').val(json.tipo),
                                 $('#tec').val(json.tecnologia),
                                 $('#app').val(json.aplicacao),
                                 $('#nome').val(json.nome),
                                 $('#number').val(json.numero),
                                 $('#ddr').val(json.ddr),
                                 $('#habDDR').val(json.ddr != null ? 1 : 0),
                                 $('#detour').val(json.desvio_para),
                                 $('#password').val(json.senha),
                                 $('#deviation').val(json.desvio_tipo),
                                 $('#central').val(json.central),
                                 $('#no_externo').val(json.no_externo),
                                 $('#conference').bootstrapSwitch('state', (json.conferencia) == '1' ? true : false),
                                 $('#centercost').bootstrapSwitch('state', (json.centro_custo) == '1' ? true : false),
                                 $('#intercomaccess').bootstrapSwitch('state', (json.Porteiro) == '1' ? true : false),
                                 $('#accountcode').bootstrapSwitch('state', (json.codigo_conta) == '1' ? true : false),
                                 $('#notdisturb').bootstrapSwitch('state', (json.nao_perturbe) == '1' ? true : false),
                                 $('#capture').bootstrapSwitch('state', (json.capturar) == '1' ? true : false),
                                 $('#parking_calls').bootstrapSwitch('state', (json.estacionar_chamadas) == '1' ? true : false),      
                                 $('#nat').bootstrapSwitch('state', (json.nat) == '1' ? true : false);
                                 $('#profile').val(json.profile_ramal_id);
                                 $('#porta').val(json.porta);

                                 $('#myModal').modal('toggle');

                              mostrarFormApp();
                              setDeviation();
                              setDesvio();
                              setUser();
                              setTec();
                              verificaDDR();    
                              setDesvioPara();
     }  

     function resetaForm(){
               console.log('resetaForm()');   
               $('#editFooter').hide();
               $('#senha').show();
               $('#cadFooter').show();
               $("#formRamais").attr('action', '{{route('admin.ramais.store')}}');
               
               $('#myModal')
                          .find("input")
                             .val('')
                             .removeAttr('readonly')
                             .end()
                          .find("input[type=checkbox], input[type=radio]")
                             .prop("checked", "")
                             .removeAttr('readonly')
                             .end()
                          .find("option")
                             .show()
                             .end()
                          .find("select")
                              .not('#profile')
                            .val('0')
                            .removeAttr('readonly')
                            .end();
                

                if ($("#profile option[value=0]").length > 0)
                {
                    $('#myModal')
                          .find("select")
                             .val('0')
                             .removeAttr('readonly')
                             .end()
                } 
                       
                          resetaCheckBoxes();
                          $('.form_din').hide();
                          $('.perguntaddr').hide();
                          $('.form_dac').hide();
                          $('.form_pabx').hide();
                          $('.profile').hide();
                          $('#editForm').hide();
                          $('#cadForm').show();
                          $('#noexterno').hide();
                          $('.porta').hide();

              $('#msgFeedBack').hide();

                          removeErrors();
   }
</script>

<script>
    $(function(){

        $('.form_din').hide();
        $('#centrais').hide();
        $('.perguntaddr').hide();
        $('.form_dac').hide();
        $('.form_pabx').hide();
        $('.profile').hide();
        $('#noexterno').hide();
        $('.detour').hide();
        $('.nat').hide();
        $('.porta').hide();


        verificaDDR();
        
        
        $('#tec').on('change', function (){
           setTec();
        
        });
        
        $('#detour').on('change', function(){
           setDesvioPara();
        });
        
       $('#deviation').on('change', function(){
           setDesvio();
       });

        $('#tipo').on('change',function(){
             setUser();
        });
        
       
        $('#app').on('change', function(){
            mostrarFormApp();
        });
        
        $('#habDDR').on('switchChange.bootstrapSwitch', function(event, state) {
                if(state == false){
                    $("#ddr").attr('readonly', 'readonly').val('');
                } 
                else {  
                    $("#ddr").removeAttr('readonly');   
                }
        });

          $.ajax({
                url: "{{route('datatables.profiles_ramais')}}", 
                type: 'get', //or POST
                success: function(profiles){
                     if(profiles.data.length >= 1){
                        $('#profile option[value=0]').remove();
                     }
                     for(i = 0; i< profiles.data.length; i++){
                         $('#profile').append('<option value='+profiles.data[i].id+'>'+profiles.data[i].nome+'</option>');
                     }
                }
           });


          $.ajax({
                url: "{{route('datatables.centrais')}}", 
                type: 'get', //or POST
                success: function(centrais){
                     centrais.data.map(function(el){ 
                          $('#central').append($('<option value='+el.id+'>'+el.nome+'</option>'));
                     });   
                }
           });


    }); //Binds
 
     


  
</script>
@endpush