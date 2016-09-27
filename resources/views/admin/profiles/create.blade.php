@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Criar perfil
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/profiles/">Perfis</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Criar perfil
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">
        {!! Form::open(array('route' => 'admin.profiles.store')) !!}

            <div class="panel-body">
                <div class="form-group">
                    <label>Nome do perfil</label>
                    <input class="form-control" placeholder="Digite o nome do perfil">
                </div>
                <div class="form-group">
                    <label>Grupo de Captura</label>
                    <input class="form-control" placeholder="Digite o grupo de captura">
                </div>
                <div class="form-group">
                    <label>Grupos que são capturados</label>
                    <input class="form-control" placeholder="Digite o grupo que é capturado">
                </div>
                <div class="form-group">
                    <label>Recebe DDR</label>
                    <select class="form-control">
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Recebe</label>
                    <select class="form-control">
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Chamada a Cobrar</label>
                    <select class="form-control">
                        <option>Sim</option>
                        <option>Não</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Envia Identificação DDR</label>
                    <select class="form-control">
                        <option>Sim</option>
                        <option>Não</option>
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
