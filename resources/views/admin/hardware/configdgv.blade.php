@extends('admin.base')
@section('content')
        <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Detectar Hardwares
        </h1>
        <ol class="breadcrumb">
             <li>
                <i class="fa fa-list"></i>  <a href="{{route('admin.troncos.index')}}">Troncos</a>
            </li>
            <li>
                 <a href="{{route('admin.hardware.index')}}">Cadastrar Hardwares</a>
            </li>
            <li class="active">
                </i> Digivoice
            </li>
        </ol>
        <div class=''>
            <h2>Arquivo de Configuração Digivoice:</h2><br>
            <div class="alert alert-success {{isset($msg) ? '' : 'hidden'}}" role="alert"> {{ isset($msg) ? $msg  : ''}}</div>
 <!--           {!! Form::model(array('route'=>'admin.hardware.savedgv', 'id'=>'formDetectHardware', 'method'=>'post')) !!} -->
            <form method="post" action='{{route('admin.hardware.savedgv')}}'>
            {{csrf_field()}}
            <input type="submit" class="btn btn-primary" value="Salvar"/ >
            
            <br>
            @if (isset($text))
            <textarea rows="25" class="filetextarea" id="dgvfile" name="dgvfile">{{ $text }}</textarea>
            <br>
            @endif
             
            </form>
            {!! Form::close() !!}       

    </div>
    </div>
  
</div>
  

@push('scripts')

@endpush
        <!-- Simple List -->

<!-- /.row -->
@endsection
