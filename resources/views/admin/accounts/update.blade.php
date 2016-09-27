@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Atualizar conta
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-dashboard"></i>  <a href="/accounts/">Usuários</a>
            </li>
            <li class="active">
                <i class="fa fa-edit"></i> Atualizar conta
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">
        {!! Form::open(array('route' => 'admin.accounts.update')) !!}

            <div class="panel-body">
                <div class="form-group">
                    <h3 ><i class="fa fa-cog"></i> Dados da conta</h3>
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" placeholder="Digite o email" value="fulano@teste.com.br">
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input class="form-control" placeholder="Digite a senha">
                </div>
                <div class="form-group">
                    <label>Confirmar senha</label>
                    <input class="form-control" placeholder="Repita a senha">
                </div>
                <div class="form-group">
                    <label>Tipo de conta</label>
                    <select class="form-control">
                        <option>Usuário</option>
                        <option>Administrador</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Grupo</label>
                    <select class="form-control">
                        <option>Grupo 1</option>
                        <option>Grupo 2</option>
                    </select>
                </div>

                <div class="form-group">
                    <h3 ><i class="fa fa-user"></i> Perfil</h3>
                </div>
                <div class="form-group">
                    <label>Nome</label>
                    <input class="form-control" placeholder="Digite o nome" value="Fulano">
                </div>
                <div class="form-group">
                    <label>Sobrenome</label>
                    <input class="form-control" placeholder="Digite o sobrenome" value="da Silva">
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
