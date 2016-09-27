@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Criar grupo
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/groups/">Grupos</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Criar grupo
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">
        {!! Form::open(array('route' => 'admin.groups.store')) !!}

            <div class="panel-body">
                <div class="form-group">
                    <label>Nome</label>
                    <input class="form-control" placeholder="Digite o nome" name="name">
                </div>
                <div class="form-group">
                    {{ Form::hidden('status', 1) }}
                    <button type="submit" class="btn btn-default">Salvar</button>
                    <button type="reset" class="btn btn-default">Limpar</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@endsection
