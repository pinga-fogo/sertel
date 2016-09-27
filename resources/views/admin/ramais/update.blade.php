@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Atualizar ramal
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/ramais/">Ramais</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Atualizar ramal
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">
        {!! Form::open(array('route' => 'admin.ramais.update')) !!}

            <div class="panel-body">
                <div class="form-group">
                    <label>Nome</label>
                    <input class="form-control" placeholder="Digite o nome" value="Ramal 1">
                </div>
                <div class="form-group">
                    <select class="form-control">
                        <option>Perfil 1</option>
                        <option>Perfil 2</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-default">Salvar</button>
                    <button type="reset" class="btn btn-default">Limpar</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@endsection
