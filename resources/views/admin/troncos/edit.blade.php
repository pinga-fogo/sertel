@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Editar Tronco
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-list"></i>  <a href="{{route('admin.troncos.index')}}">Listagem</a>
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

        {!! Form::model($resul, array('route' => array('admin.troncos.update', $resul->id), 'method'=>'put')) !!}


             @include('admin/troncos/troncosFormFields')




                <div class="form-group">
                    <button type="submit" class="btn btn-primary pull-right">Salvar</button>
                    <button type="reset" class="btn btn-default pull-right">Limpar</button>
                </div>

    

        {!! Form::close() !!}
    </div>
</div>
<!-- /.row -->
@endsection

 

