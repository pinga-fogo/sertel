@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Criar ramal
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-list"></i>  <a href="{{route('admin.ramais.index')}}">Listagem</a>
            </li>
            <li class="active">
                <i class="fa fa-plus-circle"></i> Criar ramal
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-8">
        {!! Form::open(array('route' => 'admin.ramais.store')) !!}

            <div class="panel-body">
                @include('admin/ramais/formfields')
                
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right" data-dismiss="modal">Salvar</button>
                    <button type="reset" class="btn btn-default pull-right">Limpar</button>
                </div>
            </div>


          
        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@endsection
