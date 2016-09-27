    <h1> </h1>
    <div class="form-group" data-val='exigido'>
            {{ Form::label('nome', 'Nome') }}
            {{ Form::text('nome', null, ['placeholder'=>'Digite o nome', 'class'=>'form-control', 'maxlength'=>'20']) }}  <!--  Nome -->
    </div> 

    <div class="form-group" id='tecnologia_field' data-val='exigido'>  <!--  Tecnologia -->
            {{ Form::label('tecnologia', 'Tecnologia', ['class'=>'tecnologia']) }}
            {{ Form::select('tecnologia',
             [
             0 => '‹‹ selecione ››',
             11 => 'IP',
             12 => 'GSM',
             13 => 'Digital',
             14 => 'Analógico',
             15 => 'Legado'
             ]
            , 0 , ['class'=>'form-control tecnologia', 'data-default'=>'']) }}   
    </div>  


    <!-- <input type='text' value='{{isset($resul->tecnologia) ? $resul->tecnologia : 'vazio'}}' id="corteTec" class='hidden'/> -->

    <input type='test' value='{{isset($juntorAtual) ? $juntorAtual : 'vazio' }}' class='hidden' id="juntorAtual">
    
    <input type='test' value='{{isset($resul->fabricante) ? $resul->fabricante : 'vazio' }}' class='hidden' id="resulFabricante">

    <div class="form-group form-notip juntor"  data-val='exigido'> <!-- Juntor -->
        {{ Form::label('JuntorSelect', 'Juntor') }}
        {{ Form::select('JuntorSelect',
             [ 
             '0'=>'‹‹ selecione ››'
             ]
            , 0, ['class'=> " form-control form-notip", 'data-default'=>'', 'name'=>'juntor']) }} 
    </div>

    <div class="form-group prefx_juntor"  data-val='exigido'> <!-- código de acesso -->
        {{ Form::label('prefx_juntor', 'Prefixo do Juntor') }}
        {{ Form::text('prefx_juntor', null, ['placeholder'=>'Digite o prefixo do Juntor', 'class'=>'form-control', 'data-default'=>'', 'min'=>'11', 'max'=>'99', 'maxlength'=>'2', '']) }}
    </div>

    <!-- <div class="form-group"  data-val='exigido'>
            {{ Form::label('tipo', 'Tipo') }}
            {{ Form::select('tipo',
             [
             0 => '‹‹ selecione ››',
             11 => 'Principal',
             12 => 'Auxiliar'
             ]
            , 0, ['class'=>'form-control', 'data-default'=>'']) }}    
    </div> -->
    
    <div class="form-group"  data-val='exigido'> <!--  Rota --> 
        {{ Form::label('rota', 'Rota') }}
        {{ Form::text('rota', null, ['placeholder'=>'Digite a rota (0-9)', 'class'=>'form-control', 'data-default'=>'', 'maxlength'=>'1']) }} 
    </div>

    <!--  Rota_direcional -->
    <div class="form-group" data-val='exigido'>
            {{ Form::label('rota_dir', 'Rota Direcional') }}
            {{ Form::select('rota_dir',
             [
             0 => '‹‹ selecione ››',
             11 => 'Saída',
             12 => 'Entrada',
             13 => 'Bidirecional'
             ]
            , 0, ['class'=>'form-control', 'data-default'=>'']) }}   
    </div> 

    <div class="form-group" id='fidelidade_field' data-val='exigido'>
        {{ Form::label('fidelidade', 'Operadora fidelizada') }}
        {{ Form::number('fidelidade', null, ['placeholder'=>'Digite o nº a operadora', 'class'=>'form-control', 'data-default'=>'', 'max'=>'99', 'min'=>'0', 'maxlength'=>'2', 'size'=>'2']) }}  
    </div>

    <div class="form-group form_din form_trc form_pabx ">
            {{ Form::label('remover_prefixo', 'Remover prefixo') }}
            {{ Form::select('remover_prefixo',
             [
             0 =>  'Nenhum',
             1 => 'Operadora',
             2 => 'Operadora+DDD',
             ]
            , 0, ['class'=>'form-control', 'data-default'=>'']) }}   
    </div>   

    <div class="form-group form_din form_trc form_pabx div_prefx_en"  data-val='exigido'> <!-- prefixo de entrada -->
        {{ Form::label('prefx_entrada', 'Prefixo de Entrada') }}
        {{ Form::text('prefx_entrada', null, ['placeholder'=>'Digite o prefixo de entrada', 'class'=>'form-control', 'data-default'=>'','']) }}
    </div>

    <div class="form-group form_din form_trc form_pabx div_prefx_sa"  data-val='exigido'> <!-- prefixo de saída -->
            {{ Form::label('prefx_saida', 'Prefixo de saída') }}
            {{ Form::select('prefx_saida',
             [
             0 => '‹‹ selecione ››',
             11 => '0',
             12 => '55',
             13 => '55 0',
             14 => '55 0 Cód. Área',
             17 => '55 Cód. Área',
             15 => '0 Cód. Área',
             16 => 'Cód. Área'
             ]
            , 0, ['class'=>'form-control', 'data-default'=>'']) }}
    </div>


    <div class="form-group form-ip form_trc "  data-val='exigido'> <!-- Conta_registro -->
        {{ Form::label('conta_registro', 'Conta de Registro') }}
        {{ Form::text('conta_registro', isset($attrs->conta_registro) ? $attrs->conta_registro : null, ['placeholder'=>'Digite a Conta de Registro', 'class'=>'form-control', 'data-default'=>'']) }}
    </div>



    <div class="form-group form-ip form_trc "  data-val='exigido'> <!-- Senha_registro -->
        {{ Form::label('senha_registro', 'Senha de Registro') }}
        {{ Form::text('senha_registro', isset($attrs->senha_registro) ? $attrs->senha_registro : null, ['placeholder'=>'Digite a Senha de Registro', 'class'=>'form-control', 'data-default'=>'']) }}
    </div>

    <div class="form-group form-ip form_trc " data-val='exigido'> <!-- Dominio -->
        {{ Form::label('dominio', 'Ip/Domínio') }}
        {{ Form::text('dominio', isset($attrs->dominio) ? $attrs->dominio : null, ['placeholder'=>'Digite o domínio', 'class'=>'form-control', 'data-default'=>'']) }}
    </div>

    <div class="form-group form-ip" data-val='exigido'> <!-- Host -->
        {{ Form::label('host', 'Host') }}
        {{ Form::text('host', isset($attrs->host) ? $attrs->host : null, ['placeholder'=>'Digite o host', 'class'=>'form-control', 'data-default'=>'']) }}
    </div>

    <div class="form-group form-ip form_trc " data-val='exigido'> <!-- Proxy -->
        {{ Form::label('proxy', 'Proxy') }}
        {{ Form::text('proxy', isset($attrs->proxy) ? $attrs->proxy : null, ['placeholder'=>'Digite o proxy', 'class'=>'form-control', 'data-default'=>'']) }}
    </div>

    <div class="form-group form-ip" data-val='exigido'>
            {{ Form::label('protocolo', 'Protocolo') }}
            {{ Form::select('protocolo',
             [
             0 => '‹‹ selecione ››',
             11 => 'SIP',
             12 => 'IAX2',
             13 => 'H232',
             14 => 'SIP & IAX2'
             ]
            ,  isset($attrs->protocolo) ? $attrs->protocolo : null, ['class'=>'form-control', 'data-default'=>'']) }}   <!--  Protocolo -->
    </div>  



    <div class="form-group form-ip" data-val='exigido'>
            {{ Form::label('type', 'Tipo') }}
            {{ Form::select('type',
             [
             11 => 'Peer',
             12 => 'Friend',
             13 => 'User'
             ]
            ,  isset($attrs->tipo) ? $attrs->tipo : null, ['class'=>'form-control', 'data-default'=>'']) }}   <!--  Tipo -->
    </div> 
     

    <div class="form-group form_din form_trc form_pabx" data-val='exigido'> <!-- Atendedor do juntor -->
        {{ Form::label('juntor_atend', 'Atendedor do Juntor') }}
        {{ Form::text('juntor_atend', isset($resul->juntor_atend) ? $resul->juntor_atend : null , ['placeholder'=>'Digite o n° do atendedor', 'class'=>'form-control', 'data-default'=>'','']) }}
    </div>

    <div class="form-group form_din form_trc form_pabx" data-val='exigido'> <!-- código de acesso -->
        {{ Form::label('juntor_cod_acess', 'Código de Acesso') }}
        {{ Form::text('juntor_cod_acess', isset($resul->juntor_cod_acess) ? $resul->juntor_cod_acess : null , ['placeholder'=>'Digite o código de acesso', 'class'=>'form-control', 'data-default'=>'', 'min'=>'11', 'max'=>'99', 'maxlength'=>'2', '']) }}
    </div>

    <br>

    <button id="opAvanc"  type="button" class="btn btn-default" value='0'>Opções Avançadas</button><br>


    <div class="row m20 form_facip" >
        <div class="col-lg-4 form_facip"> <!-- Reencaminhar chamadas -->
            {{ Form::label('reenc_chamadas', 'Reenc. de chamadas') }}
            <br>
            {{ Form::checkbox('reenc_chamadas', '1',  isset($attrs->reenc_chamadas) ? $attrs->reenc_chamadas :  null , ['class'=>'switch']) }}
        </div>

        <div class="col-lg-4 form_facip">  <!--  Qualify -->
        {{ Form::label('qualify', 'Qualify') }}
        <br>
       {{ Form::checkbox('qualify', '1',  isset($attrs->qualify) ? $attrs->qualify : null , ['class'=>'switch']) }}
        </div>

        <div class="col-lg-4 form_facip" >
        {{ Form::label('reinvite', 'Reinvite') }}
        <br>
        {{ Form::checkbox('reinvite', '1', isset($attrs->reinvite) ? $attrs->reinvite : null, ['class'=>'switch']) }}  <!--  Reinvite -->
        </div>

        <div class="col-lg-4">
        {{ Form::label('pro_band', 'Progressinband') }}
        <br>
        {{ Form::checkbox('pro_band', '1',  isset($attrs->pro_band) ? $attrs->pro_band  : null, ['class'=>'switch']) }}  <!--  Prosseguing Band -->
        </div><br>
    </div>

    <br>


    <div class="form-group form_facip" data-val='exigido'>
            {{ Form::label('nat', 'NAT') }}
            {{ Form::select('nat',
             [
             11 => 'Sim',
             12 => 'Não',
             13 => 'Nunca',
             14 => 'Route'
             ]
            , isset($attrs->nat) ? $attrs->nat  : null, ['class'=>'form-control', 'data-default'=>'']) }}   <!--  Nat -->
    </div> 
     
    <div class="form-group form_facip" data-val='exigido'>
            {{ Form::label('dtmf_mode', 'DtmfMode') }}
            {{ Form::select('dtmf_mode',
             [
             11 => 'Rfc2833',
             12 => 'Auto',
             13 => 'Info',
             14 => 'Inband',
             15 => 'Shortingo'
             ]
            , isset($attrs->dtmf_mode) ? $attrs->dtmf_mode  : null, ['class'=>'form-control', 'data-default'=>'']) }}   <!--  Dtmf_Mode -->
    </div> 

    <div class="form-group  form_trc form_facip " data-val='exigido'> <!-- Insecure -->
        {{ Form::label('insecure', 'Insecure') }}
        {{ Form::text('insecure', isset($attrs->insecure) ? $attrs->insecure : 'Port, Invite', ['placeholder'=>'Digite o n° da porta', 'class'=>'form-control', 'data-default'=>'']) }}
    </div>



    <div class="form-group form_trc form_facip" data-val='exigido'> <!-- Contexto -->
        {{ Form::label('contexto', 'Contexto') }}
        {{ Form::text('contexto', isset($attrs->contexto) ? $attrs->contexto : 'Sertel', ['placeholder'=>'Digite o nome do juntor', 'class'=>'form-control', 'data-default'=>'','']) }}
    </div>

    <div class="form-group  form_trc form_facip " data-val='exigido'> <!-- Porta -->
        {{ Form::label('porta', 'Porta') }}
        {{ Form::text('porta', isset($attrs->porta) ? $attrs->porta : '5060', ['placeholder'=>'Digite o n° da porta', 'class'=>'form-control', 'data-default'=>'']) }}
    </div>



    <!-- Formulário de GMS - KHOMP -->

        <fieldset>
            <legend class="gsm_khomp digital_khomp"><h4>Configurações globais</h4></legend>

            <div class="form-group gsm_khomp digital_khomp " data-val='exigido'>
            {{ Form::label('ccss_enable', 'Ccss-enable') }}
            {{ Form::select('ccss_enable',
             [
             'Ccss-disable = disabled' => 'Desabilitado',
             'Ccss-enable = enabled' => 'Habilitado'
             ]
            , isset($attrs->ccss_enable) ? $attrs->ccss_enable : '5060', ['class'=>'form-control', 'data-default'=>'']) }} 
            </div> 

            <div class="form-group gsm_khomp digital_khomp" data-val='exigido'> <!-- audio-rx-sync -->
                {{ Form::label('audio_rx_sync', 'Audio-rx-sync') }}
                {{ Form::text('audio_rx_sync', isset($attrs->audio_rx_sync) ? $attrs->audio_rx_sync : null , ['placeholder'=>'Auto', 'class'=>'form-control', 'data-default'=>'',]) }}
            </div>

            <div class="form-group gsm_khomp" data-val='exigido' > <!-- context-gsm-call -->
                {{ Form::label('context_gsm_call', 'Context-gsm-call') }}
                {{ Form::text('context_gsm_call', isset($attrs->context_gsm_call) ? $attrs->context_gsm_call: null, ['placeholder'=>'Khomp-DD-CC', 'class'=>'form-control', 'data-default'=>'',]) }}
            </div>

            <div class="form-group gsm_khomp" data-val='exigido'> <!-- context-gsm-sms -->
                {{ Form::label('context_gsm_sms', 'Context-gsm-sms') }}
                {{ Form::text('context_gsm_sms',  isset($attrs->context_gsm_sms) ? $attrs->context_gsm_sms: null, ['placeholder'=>'Khomp-DD-CC', 'class'=>'form-control', 'data-default'=>'', ]) }}
            </div>
            <div class="form-group digital_khomp" data-val='exigido'> <!-- context-gsm-sms -->
                {{ Form::label('context_digital', 'Contexto digital') }}
                {{ Form::text('context_digital', isset($attrs->context_digital) ? $attrs->context_digital: null, ['placeholder'=>'Khomp-DD-CC', 'class'=>'form-control', 'data-default'=>'', ]) }}
            </div>
        </fieldset>

        <div class="form-group">

          <fieldset>
            <legend class="gsm_khomp digital_khomp subtitle harder">Controle de volume</h4></legend>
            <table class="tg2 gsm_khomp digital_khomp">
            <tr>
            <th class="tg-yw40">{{ Form::label('volume_tx', 'Volume TX:', ['class'=>'label-volume']) }}{{ Form::input('range', 'audio_tx', isset($attrs->volume_rx) ? $attrs->volume_rx: '0' , ['min'=>'-10', 'max'=>'10', 'class'=>'range-volume', 'id'=>'audio_tx']) }}</th>
            <th class="tg-yw40">{{ Form::text('volume_tx',  isset($attrs->volume_tx) ? $attrs->volume_tx: '0' , ['class'=>'caixa-volume', 'id'=>'volume_tx_v']) }}</th>
            <th class="tg-yw40"></th>
            <th class="tg-yw40">{{ Form::label('volume_rx', 'Volume RX:', ['class'=>'label-volume']) }} {{ Form::input('range', 'audio_rx', isset($attrs->volume_rx) ? $attrs->volume_rx: '0' , ['min'=>'-10', 'max'=>'10', 'class'=>'range-volume', 'id'=>'audio_rx']) }}</th>
            <th class="tg-yw42">{{ Form::text('volume_rx',   isset($attrs->volume_rx) ? $attrs->volume_rx: '0' , ['class'=>'caixa-volume', 'id'=>'volume_rx_v']) }}</th>
            <th class="tg-yw40"></th>
            <th class="tg-yw40"></th>

            </tr>
            </table>
          </fieldset>
        </div>



    <div class="form-group gsm_khomp" >
            {{ Form::label('suprimir_id', 'Suprimir Identidade') }}
            {{ Form::select('suprimir_id',
             [
             'disabled' => 'Desabilitado',
             'enabled' => 'Habilitado'
             ]
            , null, ['class'=>'form-control', 'data-default'=>'']) }} 
    </div>


    <div class="form-group gsm_khomp digital_khomp">
            {{ Form::label('block_call', 'Bloquear chamadas a cobrar') }}
            {{ Form::select('block_call',
             [
             'disabled' => 'Desabilitado',
             'enabled' => 'Habilitado'
             ]
            , isset($attrs->block_call) ? $attrs->block_call : null , ['class'=>'form-control', 'data-default'=>'']) }} 
    </div>

    <div class="form-group gsm_khomp digital_khomp">
            {{ Form::label('disconnect_call', 'Desconectar chamadas em') }}
            {{ Form::select('disconnect_call',
             [
             'disabled' => 'Desabilitado',
             'tons_de_caixa' => 'Tons de caixa postal',
             'att_humano' => 'Atendimento humano',
             'sec_eletronica' => 'Secretária Eletrônica',
             'msg_operadora' => 'Mensagens da operadora',
             'att_desconhecido' => 'Atendimento desconhecido',
             'sinal_de_fax' => 'Sinal de fax'
             ]
            , isset($attrs->disconnect_call) ? $attrs->disconnect_call : null , ['class'=>'form-control', 'data-default'=>'']) }} 
    </div>

    </fieldset>
    <br>

    <div id="analog_khomp" class="analog_khomp" data-val='exigido'>  
        <div class="form-group" > 
             {{ Form::label('context_fxo', 'Context-fxo') }}
             {{ Form::text('context_fxo', isset($attrs->context_fxo) ? $attrs->context_fxo : 'Khomp-DD-CC', ['placeholder'=>'Khomp-DD-CC', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>
        <div class="form-group" data-val='exigido'> 
             {{ Form::label('context-fxo-alt ', 'Context-fxo-alt') }}
             {{ Form::text('context_fxo_alt', isset($attrs->context_fxo_alt) ? $attrs->context_fxo_alt : 'Khomp-DD', ['placeholder'=>'Khomp-DD', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>
        <div class="form-group" data-val='exigido'>
             {{ Form::label('fxo_fsk_detection', 'Fxo-fsk-detection') }}
             {{ Form::text('fxo_fsk_detection', isset($attrs->fxo_fsk_detection) ? $attrs->fxo_fsk_detection : 'bell', ['placeholder'=>'bell', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>
        <div class="form-group" data-val='exigido'> 
             {{ Form::label('fxo_fsk_timeout', 'Fxo-fsk-timeout') }}
             {{ Form::text('fxo_fsk_timeout', isset($attrs->fxo_fsk_timeout) ? $attrs->fxo_fsk_timeout : '2000', ['placeholder'=>'2000', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>
        <div class="form-group" data-val='exigido'> 
             {{ Form::label('fxo_user_xfer_delay', 'Fxo-user-xfer-delay') }}
             {{ Form::text('fxo_user_xfer_delay', isset($attrs->fxo_user_xfer_delay) ? $attrs->fxo_user_xfer_delay : '1000', ['placeholder'=>'1000', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>
        <div class="form-group" data-val='exigido'>  
             {{ Form::label('fxo_send_pre_audio', 'Fxo-send-pre-audio') }}
             {{ Form::select('fxo_send_pre_audio',
             [
             'yes' => 'sim',
             'no' => 'nao'  
             ]
            , isset($attrs->fxo_send_pre_audio) ? $attrs->fxo_send_pre_audio : '1000' , ['class'=>'form-control', 'data-default'=>'']) }}   <!--  Tecnologia -->
        </div>
        <div class="form-group" data-val='exigido' > <!-- context-gsm-call -->
            {{ Form::label('fxo_busy_disconnection', 'Fxo-busy-disconnection') }}
            {{ Form::text('fxo_busy_disconnection', isset($attrs->fxo_busy_disconnection) ? $attrs->fxo_busy_disconnection :  '1250', ['placeholder'=>'1250', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div> <!-- analogico_khomp -->
    </div>


    <div class='digital_khomp' data-val='exigido'>
        <legend class="gsm_khomp digital_khomp"><h4>Configuração de Canais</h4></legend>
        <div class="form-group"> 
            {{ Form::label('language', 'Language') }}
            {{ Form::text('language', isset($attrs->language) ? $attrs->language :  'Pt-br', ['placeholder'=>'Pt-br', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>

        <div class="form-group" data-val='exigido'> 
        {{ Form::label('mohclass', 'Mohclass') }}
        {{ Form::text('mohclass', isset($attrs->mohclass) ? $attrs->mohclass :  'Default', ['placeholder'=>'Default', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>

        <div class="form-group" data-val='exigido'> 
            {{ Form::label('flash_behaviour', 'Flash behaviour') }}
            {{ Form::text('flash_behaviour', isset($attrs->flash_behaviour) ? $attrs->flash_behaviour : 'Auto', ['placeholder'=>'Auto', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>

        <div class="form-group" data-val='exigido'> 
            {{ Form::label('pendulum_digits', 'Pendulum digits') }}
            {{ Form::text('pendulum_digits', isset($attrs->flash_behaviour) ? $attrs->flash_behaviour : 'Auto', ['placeholder'=>'Auto', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div>

        <div class="form-group" data-val='exigido'> 
            {{ Form::label('pendulum_hu_digits', 'Pendulum hang up digits') }}
            {{ Form::text('pendulum_hu_digits',  isset($attrs->flash_behaviour) ? $attrs->flash_behaviour : 'Auto', ['placeholder'=>'Auto', 'class'=>'form-control', 'data-default'=>'',]) }}
        </div><!-- digital_khomp -->
    </div>


    <fieldset>
        <legend class="gsm_khomp digital_khomp"><h4>Configuração de Cadência</h4></legend>
        <table class="tg gsm_khomp digital_khomp" id="table_cadences">
               <tr>
                <th class="tg-yw4l">{{ Form::label('co_dialtone', 'Co-dialtone') }}</th>
                <th class="tg-yw4l">{{ Form::text('co_dialtone', isset($attrs->co_dialtone) ? $attrs->co_dialtone : null, ['placeholder'=>'0,0', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}</th>
                <th class="tg-yw4l">{{ Form::label('vm_dialtone', 'Vm-dialtone') }}</th>
                <th class="tg-yw4l">{{ Form::text('vm_dialtone', isset($attrs->vm_dialtone) ? $attrs->vm_dialtone : null, ['placeholder'=>'1000,100,100,100', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}</th>
              </tr>
              <tr>
                <td class="tg-yw4l">{{ Form::label('pbx_dialtone', 'Pbx-dialtone') }}</td>
                <td class="tg-yw4l">{{ Form::text('pbx_dialtone', isset($attrs->pbx_dialtone) ? $attrs->pbx_dialtone : null, ['placeholder'=>'1000,100', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}</td>
                <td class="tg-yw4l">{{ Form::label('fast_busy', 'Fast-busy') }}</td>
                <td class="tg-yw4l">{{ Form::text('fast_busy', isset($attrs->fast_busy) ? $attrs->fast_busy : null, ['placeholder'=>'100,100', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}</td>
              </tr>
              <tr>
                <td class="tg-yw4l">{{ Form::label('ring_back', 'Ringback') }}</td>
                <td class="tg-yw4l">{{ Form::text('ring_back', isset($attrs->ring_back) ? $attrs->ring_back : '100,4000' , ['placeholder'=>'100,4000', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}</td>
                <td class="tg-yw4l">{{ Form::label('waiting_call', 'Waiting Call') }}</td>
                <td class="tg-yw4l">{{ Form::text('waiting_call', isset($attrs->waiting_call) ? $attrs->waiting_call : null, ['placeholder'=>'100,100,100,3700', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}</td>
              </tr>
              <tr>
                <td class="tg-yw4l">{{ Form::label('ring', 'Ring') }}</td>
                <td class="tg-yw4l">{{ Form::text('ring', isset($attrs->ring) ? $attrs->ring : null, ['placeholder'=>'1000,4000', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}</td>
              </tr> <!-- configuração de cadência -->    
      </table>
    </fieldset>
      <!--<input type="text" id="cad_stringbuffer" name="cad_stringbuffer" class="hidden"/> -->
      <button type="button" id='newCadBtn' class="btn btn-info gsm_khomp digital_khomp"/>Nova Cadência </button>
       <br>
       <br>
              <div class="form-group newcad" id='newcad'>
                                      {{ Form::label('nome_cad', 'Nome da cadência: ') }}
                                      {{ Form::text('nome_cad', isset($attrs->nome_cad) ? $attrs->nome_cad : null, ['placeholder'=>'Nome da cadência', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}
                                      <br>
                                      {{ Form::label('val_cad', 'Valor da cadência: ') }}
                                      {{ Form::text('val_cad', isset($attrs->val_cad) ? $attrs->val_cad : null, ['placeholder'=>'Valor da cadência', 'class'=>'form-cadencia', 'data-default'=>'', ]) }}<br>
              <button type="button" class="btn btn-default" id='salvarCad'>Salvar Cadência</button>
              </div>
    </fieldset>
 
    
    <fieldset id='field_cads_personalizadas' class='gsm_khomp digital_khomp'>
       <legend class='cads_personalizadas'><h4>Cadências Personalizadas </h4> </legend>
           <div id='div_cads_personalizadas' class='cads_personalizadas' class='form-group'>
           </div>
    </fieldset>

    @push('scripts')
    <!-- <script src="/assets/js/jquery.maskedinput.min.js"></script> -->

    <script>
         $(function(){
         
         $("#nome").on('input', function(arg1, arg2, arg3){
               var valor = $("#nome").val();
               var ultimo_digito = valor.substr(-1, 1);
           
               if( ultimo_digito == '-' ||  ultimo_digito == '/'){
                    $("#nome").val(valor.substr(0, valor.length-1));
               }
         });

         $('#fidelidade').on('input', function(){
                var valor = $(this).val();
                if (valor.length > 2){
                     valor = valor.split('');
                     valor.pop();
                     $(this).val(valor.join(''));
                }
         });         
         
         /** quando esconder o modal ele vai resetar o formulário **/ 
         $('#myModal').on('hidden.bs.modal', function () {
             resetaForm();
         });
         
         /** esconde a div de cadências personalizadas**/
         //$('#field_cads_personalizadas').hide();
         $('.cads_personalizadas').hide();
        
         /** A ação de salvar uma cadência **/ 
         $('#salvarCad').on('click', function(){

           if( ( !$('#'+$('#nome_cad').val()).length && ($('nome_cad').val() != '') && ($('val_cad').val() != ''))){
               
               foo = ("<div id='"+$('#nome_cad').val()+"'>\
                <label>"+$('#nome_cad').val()+"  </label>\
                <input class='form-cadencia ' type='text' name='' value='"+$('#val_cad').val()+"'/>\
                <input class='hidden' type='text' name='cadencias[]' value='"+$('#nome_cad').val()+"&"+$('#val_cad').val()+"'>\
                <a href='javascript:delCadencia_NA("+$("#nome_cad").val()+")' class='fake-linkRed'> <i class='fa fa-times' aria-hidden='true'></i> </a><br>\
                </div><br>\
                ");

               $('#div_cads_personalizadas').append($(foo));

               $('#newcad').hide();
           
           }
           

          });

         $.ajax({
           'url': '{!! route('datatables.juntorMin') !!}',
           'type': 'GET',
           success: function(result) {     
                     if(result.length < 1){
                        var emptyMsg = "<br><i class='fa fa-exclamation-triangle fa-2x' aria-hidden='true'></i>\
                                    <p class='text-danger'>Nenhum Juntor Cadastrado</p>\
                                    <p class='text-danger'>Clique <a href='{{route('admin.juntor.listar')}}'>AQUI</a> para Adicionar um.</p></div>";
                        $('#JuntorSelect').after(emptyMsg);            
                     }
                     
                     $.each(result, function (i, item) {
                        switch(item.fabricante){
                                 case ('11') : item.fabricante = 'KHOMP'; break; 
                                 case ('12') : item.fabricante = 'Intelbras'; break;
                                 case ('13') : item.fabricante = 'Digium'; break;
                                 case ('14') : item.fabricante = 'Digivoice'; break;
                                 case ('15') : item.fabricante = 'Sangoma'; break;  
                                 case ('16') : item.fabricante = 'Dahdi'; break;  
                     }
                        
                    /** no caso da edição...**/
                    if ( $('#juntorAtual').val() != 'vazio' && item.id == $('#juntorAtual').val()){                  
                           $("#JuntorSelect option[value='0']").remove();  
                    }

                    $('#JuntorSelect').append($('<option>', { 
                    value : item.id+'-'+item.fabricante,
                    text  : item.nome+' - '+item.fabricante,
                    class : item.fabricante                        
                    }));     
               }); 
           }
         });

           //$('#host').mask("999.999.999.999");
           //$('#proxy').mask("999.999.999.999");
     
           

           $('#newCadBtn').on('click', function(){
                 $('#newcad').toggle();
           });
    });

    </script>
    @endpush 