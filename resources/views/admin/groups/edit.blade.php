@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Atualizar grupo
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/groups/">Grupos</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Atualizar grupo
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">
        {!! Form::model($entity, ['route' => ['admin.groups.update'], 'method'=>'put']) !!}

            <div class="panel-body">
                <div class="form-group">
                    <label>Nome</label>
                    {{ Form::text('name', null, ['placeholder'=>'Digite o nome', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::hidden('id', null) }}
                    <button type="submit" class="btn btn-default">Salvar</button>
                    <button type="reset" class="btn btn-default">Limpar</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@endsection
