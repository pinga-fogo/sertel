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
                    <i class="fa fa-edit"></i> Atualizar
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            {!! Form::model($entity, ['route' => ['admin.ramais.settings.update'], 'method'=>'put']) !!}

            <div class="panel-body">
                <div class="form-group">
                    {{ Form::label('master', 'Base') }}
                    {{ Form::select('master', $masters, null, ['class'=>'form-control masterSelect']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('parent_id', 'Tipo') }}
                    {{ Form::select('parent_id', $types, null, ['class'=>'form-control fieldTypes']) }}
                </div>

                <div class="form-group">
                    {{ Form::label('name', 'Nome do sub-tipo') }}
                    {{ Form::text('name', null, ['placeholder'=>'Nome do sub-tipo', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::hidden('id', null) }}
                    <input type="hidden" name="class" value="subtype">
                    <button type="submit" class="btn btn-primary pull-right">Atualizar</button>
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
            });
        </script>
    @endpush
    <!-- Simple List -->

    <!-- /.row -->
@endsection
