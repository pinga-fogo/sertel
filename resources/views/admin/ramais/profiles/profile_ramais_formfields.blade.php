<center>

            <div class="form-group">
                {{ Form::text('antigos', null, ['class'=>'hidden']) }}
            </div>
             <div class="form-group">
                {{ Form::text('nomesStringbuffer', null, ['class'=>'hidden', 'id'=>'nomesStringbuffer']) }}
            </div>
             <div class="form-group">
                {{ Form::text('id', null, ['class'=>'hidden', 'id'=>'id']) }}
            </div>

            <div class="form-group" data-val='exigido'>
                {{ Form::label('nome', 'Nome do perfil') }}
                {{ Form::text('nome', null, ['placeholder'=>'Nome do perfil', 'class'=>'form-control','maxlength'=>'19']) }}
            </div>
            <div class="form-group" data-val='exigido'>
                {{ Form::label('group_capture', 'Grupo de captura') }}
                {{ Form::text('group_capture', null, ['placeholder'=>'1,2,3-9', 'class'=>'form-control']) }}
            </div>
            <div class="form-group" data-val='exigido'>
                {{ Form::label('capture_groups', 'Captura os grupos') }}
                {{ Form::text('capture_groups', null, ['placeholder'=>'1,2,3-9', 'class'=>'form-control']) }}
            </div>
             
             <div class="form-group">
                <div class="row m20">
                    <div class="col-xs-6">
                        {{ Form::label('mcdu_send', 'Envio de MCDU') }}
                        <br>
                        {{ Form::checkbox('mcdu_send', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
                    </div>
                    <div class="col-xs-6">
                        {{ Form::label('collect_call', 'Aceita chamada a cobrar') }}
                        <br>
                        {{ Form::checkbox('collect_call', '1', false, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>

            <br>
            <h4>Categoria de acessos:</h4><br>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('internal_access', 'Acesso Interno') }}
                        <br>
                        {{ Form::checkbox('internal_access', '1', false, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('local_access', 'Acesso Local') }}
                        <br>
                        {{ Form::checkbox('local_access', '1', false, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('fixed_access_ddd', 'Acesso Fixo DDD') }}
                        <br>
                        {{ Form::checkbox('fixed_access_ddd', '1', false, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('access_mobile_local', 'Acesso Movel Local') }}
                        <br>
                        {{ Form::checkbox('access_mobile_local', '1', false, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('ddd_mobile_access', 'Acesso Movel DDD') }}
                        <br>
                        {{ Form::checkbox('ddd_mobile_access', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('special_access', 'Acesso especial') }}
                        <br>
                        {{ Form::checkbox('special_access', '1', false, ['class'=>'switch', 'data-default'=>'1']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('access_number_services', 'Acesso nº Seviços') }}
                        <br>
                        {{ Form::checkbox('access_number_services', '1', false, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('especial_access_rota', 'Acesso a Rota Especial') }}
                        <br>
                        {{ Form::checkbox('especial_access_rota', '1', false, ['class'=>'switch']) }}
                    </div>
                
                </div>
            </div>
       <br> <!-- <p class="separador"></p><br> -->
            <!-- <h4>Bloco 1</h4> -->
                        <h4>Acesso às facilidades:</h4><br>

            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('agenda', 'Agenda') }}
                        <br>
                        {{ Form::checkbox('agenda', '1', false, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('padlock', 'Cadeado') }}
                        <br>
                        {{ Form::checkbox('padlock', '1', false, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('conference', 'Conferência') }}
                        <br>
                        {{ Form::checkbox('conference', '1', false, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('query_sale', 'Consulta de saldo') }}
                        <br>
                        {{ Form::checkbox('query_sale', '1', false, ['class'=>'switch']) }}
                    </div>
                    
                    <div class="col-lg-4">
                        {{ Form::label('enable_follow_me', 'Habilitar siga-me') }}
                        <br>
                        {{ Form::checkbox('enable_follow_me', '1', false, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
                     
            <!-- <h4>Bloco 2</h4> -->
            <div class="form-group">
                <div class="row m20">
                   <div class="col-lg-4">
                        {{ Form::label('server_information', 'Informações do servidor') }}
                        <br>
                        {{ Form::checkbox('server_information', '1', false, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('login_queue', 'Queue') }}
                        <br>
                        {{ Form::checkbox('login_queue', '1', false, ['class'=>'switch']) }}
                    </div>
                  <!--  <div class="col-lg-4">
                        {{ Form::label('last_call_external', 'Última chamada externa') }}
                        <br>
                        {{ Form::checkbox('last_call_external', '1', false, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('last_internal_call', 'Última chamada interna') }}
                        <br>
                        {{ Form::checkbox('last_internal_call', '1', false, ['class'=>'switch']) }}
                    </div> -->
                    <div class="col-lg-4">
                        {{ Form::label('last_external_number_received', 'Último nº recebido externo') }}
                        <br>
                        {{ Form::checkbox('last_external_number_received', '1', false, ['class'=>'switch']) }}
                    </div>

                </div>
            </div>
           <br><br>
           <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('last_received_number_internal', 'Último nº recebido interno') }}
                        <br>
                        {{ Form::checkbox('last_received_number_internal', '1', false, ['class'=>'switch']) }}
                    </div>
                     <div class="col-lg-4">
                        {{ Form::label('access_to_voice_mail', 'Acesso ao correio de voz') }}
                        <br>
                        {{ Form::checkbox('access_to_voice_mail', '1', false, ['class'=>'switch']) }}
                    </div> 
                     <div class="col-lg-4">
                        {{ Form::label('ramal_talks', 'Fala ramal') }}
                        <br>
                        {{ Form::checkbox('ramal_talks', '1', false, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <!-- <h4>Bloco 3</h4> -->
            <div class="form-group">
                <div class="row m20">
                   
                </div><br>
            </div>
</center>            