@extends('admin.base')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Configurações de Ramal
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-list"></i> Listagem
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <fieldset>
                <legend>Filtro</legend>
                {!! Form::open(array('route' => 'admin.accounts.store', 'id'=>'formSearchRamalSetting')) !!}
                <div class="panel-body">
                    <div class="form-group">
                        {{ Form::label('parent_id', 'Base') }}
                        {{ Form::select('parent_id', $masters, null, ['class'=>'form-control masterSelect']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('type', 'Tipo') }}
                        {{ Form::select('type', $types, null, ['class'=>'form-control fieldTypes']) }}
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary pull-right">Listar</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </fieldset>
        </div>
    </div>

    {{-- para carregar listagem com data table --}}
    @include('admin.ramais.settings.datatable')
@endsection
