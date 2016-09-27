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
                <i class="fa fa-list"></i>  <a href="{{route('admin.accounts.index')}}">Listagem</a>
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

        @include('admin.showerros')

        {!! Form::model($user, ['route' => ['admin.accounts.update'], 'method'=>'put']) !!}

            <div class="panel-body">
                <div class="form-group">
                    <h3 ><i class="fa fa-cog"></i> Dados da conta</h3>
                </div>
                <div class="form-group">
                    {{ Form::label('name', 'Nome') }}
                    {{ Form::text('name', null, ['placeholder'=>'Digite o nome', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('lastname', 'Sobrenome') }}
                    {{ Form::text('lastname', $user->profile->lastname, ['placeholder'=>'Digite o sobrenome', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::text('email', null, ['placeholder'=>'Digite o email', 'class'=>'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::hidden('id', null) }}
                    <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                    <button type="reset" class="btn btn-default pull-right">Limpar</button>
                </div>
            </div>
        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@endsection
