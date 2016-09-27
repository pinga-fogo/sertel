@extends('admin.base')
@section('content')
        <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Atualizar Configurações de Ramal
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-list"></i>  <a href="{{route('admin.ramais.profiles.index')}}">Listagem</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Atualizar
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        {!! Form::model($entity, ['route' => ['admin.ramais.profiles.update'], 'method'=>'put']) !!}

        <div class="panel-body">
            <div class="form-group">
                {{ Form::label('name', 'Nome do perfil') }}
                {{ Form::text('name', null, ['placeholder'=>'Nome do perfil', 'class'=>'form-control']) }}
            </div>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('receives_ddr', 'Receber ddr') }}
                        <br>
                        {{ Form::checkbox('receives_ddr', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('mcdu_send', 'Envio de MCDU') }}
                        <br>
                        {{ Form::checkbox('mcdu_send', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('collect_call', 'Aceita chamada a cobrar') }}
                        <br>
                        {{ Form::checkbox('collect_call', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {{ Form::label('group_capture', 'Grupo de captura') }}
                {{ Form::text('group_capture', null, ['placeholder'=>'1,2,3-9', 'class'=>'form-control']) }}
            </div>
            <div class="form-group">
                {{ Form::label('capture_groups', 'Captura os grupos') }}
                {{ Form::text('capture_groups', null, ['placeholder'=>'1,2,3-9', 'class'=>'form-control']) }}
            </div><br>
            <h4>Categoria de acessos:</h4>
            <div class="form-group">
                <div class="row m20">
                  <<div class="col-lg-4">
                        {{ Form::label('internal_access', 'Acesso Interno') }}
                        <br>
                        {{ Form::checkbox('internal_access', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('local_access', 'Acesso Local') }}
                        <br>
                        {{ Form::checkbox('local_access', '1', null, ['class'=>'switch']) }}
                    </div> 
                    <div class="col-lg-4">
                        {{ Form::label('fixed_access_ddd', 'Acesso Fixo DDD') }}
                        <br>
                        {{ Form::checkbox('fixed_access_ddd', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('access_mobile_local', 'Acesso Movel Local') }}
                        <br>
                        {{ Form::checkbox('access_mobile_local', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('ddd_mobile_access', 'Acesso Movel DDD') }}
                        <br>
                        {{ Form::checkbox('ddd_mobile_access', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('special_access', 'Acesso especial') }}
                        <br>
                        {{ Form::checkbox('special_access', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('access_number_services', 'Acesso nº Seviços') }}
                        <br>
                        {{ Form::checkbox('access_number_services', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('especial_access_rota', 'Acesso a Rota Especial') }}
                        <br>
                        {{ Form::checkbox('especial_access_rota', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <!-- <h4>Bloco 1:</h4> --><br>
            <h4> Acesso às facilidades:</h4>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('agenda', 'Agenda') }}
                        <br>
                        {{ Form::checkbox('agenda', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('padlock', 'Cadeado') }}
                        <br>
                        {{ Form::checkbox('padlock', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('conference', 'Conferência') }}
                        <br>
                        {{ Form::checkbox('conference', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('query_sale', 'Consulta de saldo') }}
                        <br>
                        {{ Form::checkbox('query_sale', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('enable_follow_me', 'Habilitar siga-me') }}
                        <br>
                        {{ Form::checkbox('enable_follow_me', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('do_not_disturb', 'Não pertube') }}
                        <br>
                        {{ Form::checkbox('do_not_disturb', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <!-- <h4>Bloco 2</h4> -->
            <div class="form-group">
                <div class="row m20">
                     <div class="col-lg-4">
                        {{ Form::label('server_information', 'Informações do servidor') }}
                        <br>
                        {{ Form::checkbox('server_information', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('login_queue', 'Queue') }}
                        <br>
                        {{ Form::checkbox('login_queue', '1', null, ['class'=>'switch']) }}
                    </div>
                   <!-- <div class="col-lg-4">
                        {{ Form::label('last_call_external', 'Última chamada externa') }}
                        <br>
                        {{ Form::checkbox('last_call_external', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('last_internal_call', 'Última chamada interna') }}
                        <br>
                        {{ Form::checkbox('last_internal_call', '1', null, ['class'=>'switch']) }}
                    </div> -->
                    <div class="col-lg-4">
                        {{ Form::label('last_external_number_received', 'Último nº recebido externo') }}
                        <br>
                        {{ Form::checkbox('last_external_number_received', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('last_received_number_internal', 'Último nº recebido interno') }}
                        <br>
                        {{ Form::checkbox('last_received_number_internal', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('access_to_voice_mail', 'Acesso ao correio de voz') }}
                        <br>
                        {{ Form::checkbox('access_to_voice_mail', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('ramal_talks', 'Fala ramal') }}
                        <br>
                        {{ Form::checkbox('ramal_talks', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div>
            <!-- <h4>Bloco 3</h4> -->
            <div class="form-group">
                <div class="row m20">
                 
                </div>
            </div>
            <!--  h4>Bloco 4</h4> -->
            <!--<div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('intercalation', 'Intercalação') }}
                        <br>
                        {{ Form::checkbox('intercalation', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('monitoring_spy', 'Monitoriamento spy') }}
                        <br>
                        {{ Form::checkbox('monitoring_spy', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div> 
            <h4>Bloco 5</h4>-->
            <div class="form-group">
                <div class="row m20">
                    
                    <!--<div class="col-lg-4">
                        {{ Form::label('logout_queue', 'Logout da queue') }}
                        <br>
                        {{ Form::checkbox('logout_queue', '1', null, ['class'=>'switch']) }}
                    </div>
                    <div class="col-lg-4">
                        {{ Form::label('pause_queue', 'Pausa na queue') }}
                        <br>
                        {{ Form::checkbox('pause_queue', '1', null, ['class'=>'switch']) }}
                    </div> -->
                </div>
            </div>
             <!--<div class="form-group">
                <div class="row m20">
                    <div class="col-lg-4">
                        {{ Form::label('exit_pause_queue', 'Sair de pausa na queue') }}
                        <br>
                        {{ Form::checkbox('exit_pause_queue', '1', null, ['class'=>'switch']) }}
                    </div>
                </div>
            </div> -->
            <div class="form-group">
                {{ Form::hidden('id', null) }}
                <button type="submit" class="btn btn-primary pull-left">Salvar</button>
                <button type="reset" class="btn btn-default pull-left">Limpar</button>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>
<div class="row">

</div>
@push('scripts')
<script>
    function getSubTypes(parent_id){
        $('.fieldSubTypes').html('<option>carregando..</option>');
        $.get('{{route('admin.ramais.settings.subtypes')}}',{parent_id:parent_id}, function(data){
            var html = '';
            var subtypeId = $('#subtype_id').val();
            for(i in data.subtypes){
                var selected = (subtypeId==i) ? ' selected="selected" ' : '';
                html += '<option value="'+i+'" '+selected+'>'+data.subtypes[i]+'</option>';
            }
            $('.fieldSubTypes').html(html);
        },'json');
    }
    $(function(){
        getSubTypes($('.fieldTypes').val());
        $('.fieldTypes').change(function(){
            getSubTypes($('.fieldTypes').val());
        });
        // provisório
        $('.masterSelect').find('option[value=15]').attr('disabled','disabled');
    });
</script>
@endpush
        <!-- Simple List -->

<!-- /.row -->
@endsection
