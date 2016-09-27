@extends('admin.base')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Configurações de Ramal
            </h1>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-list"></i>  <a href="{{route('admin.ramais.settings.index')}}">Listagem</a>
                </li>
                <li class="active">
                    <i class="fa fa-plus-circle"></i> Cadastrar
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            {!! Form::open(array('route' => 'admin.ramais.settings.store', 'id'=>'formCreateRamalSetting')) !!}

            <div class="panel-body">
                <div class="form-group">
                    {{ Form::label('parent_id', 'Base') }}
                    {{ Form::select('parent_id', $masters, null, ['class'=>'form-control masterSelect']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('tec', 'Tecnologia') }}
                    {{ Form::select('tec', [], null, ['class'=>'form-control fieldTypes']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('app', 'Aplicação') }}
                    {{ Form::select('app', [], null, ['class'=>'form-control fieldTypes']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('type', 'Tipo') }}
                    {{ Form::select('type', $types, null, ['class'=>'form-control fieldTypes']) }}
                </div>


                <div class="form-group">
                    {{ Form::label('subtype', 'Nome do sub-tipo') }}
                    {{ Form::text('subtype', null, ['placeholder'=>'Nome do sub-tipo', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    <input type="hidden" name="class" value="subtype">
                    <button type="submit" class="btn btn-primary pull-right">Cadastrar</button>
                    <button type="reset" class="btn btn-default pull-right">Limpar</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <div class="row">

    </div>
    @push('scripts')
        <script>
            $(function(){
                // provisório
                $('.masterSelect').find('option[value=15]').attr('disabled','disabled');


                $('#tec').change(function(){
                    getApp();
                });

                getTec();
            });
            function getTec(){
                $('#tec').html('<option>carregando..</option>');
                getSubTypes(2, function(obj, html){
                    $('#tec').html(html);
                })
            }
            function getApp(){
                $('#app').html('<option>carregando..</option>');
                var tec_id = $('#tec').val();
                getSubTypes(tec_id, function(obj, html){
                    $('#app').html(html);
                })
            }

            function getSubTypes(parent_id, fnCallback){
                $.get('{{route('admin.ramais.settings.subtypes')}}',{parent_id:parent_id}, function(data){
                    var html = '';
                    for(i in data.subtypes){
                        html += '<option value="'+i+'" >'+data.subtypes[i]+'</option>';
                    }
                    fnCallback(data, html);
                },'json');
            }
        </script>
    @endpush
    <!-- Simple List -->

    <!-- /.row -->
@endsection
