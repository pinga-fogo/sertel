@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Criar conta
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-list"></i>  <a href="{{route('admin.accounts.index')}}">Listagem</a>
            </li>
            <li class="active">
                <i class="fa fa-plus-circle"></i> Criar conta
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">

        @include('admin.showerros')

        {!! Form::open(array('route' => 'admin.accounts.store')) !!}

            <div class="panel-body">
                <div class="form-group">
                    <h3 ><i class="fa fa-cog"></i> Dados da conta</h3>
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Nome') }}
                    {{ Form::text('name', null, ['placeholder'=>'Digite o nome', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Sobrenome') }}
                    {{ Form::text('lastname', null, ['placeholder'=>'Digite o sobrenome', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, ['placeholder'=>'Digite o email', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', 'Senha') }}
                    {{ Form::password('password', ['placeholder'=>'Digite a senha', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', 'Confirmar senha') }}
                    {{ Form::password('password_confirmation', ['placeholder'=>'Confirmar senha', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::hidden('status', 1) }}
                    <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                    <button type="reset" class="btn btn-default pull-right">Limpar</button>
                </div>
            </div>

        {!! Form::close() !!}

    </div>
</div>
<!-- /.row -->
@endsection
