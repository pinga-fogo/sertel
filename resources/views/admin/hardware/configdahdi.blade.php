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
                </i> Dahdi
            </li>
        </ol>
        <div class=''>
            <h2>Arquivo de Configuração Dahdi:</h2><br>
            
            @if(isset($msg) && !isset($err))
                <div class="alert alert-success {{ isset($msg) ? '' : 'hidden'}} {{ isset($err)? 'hidden' : '' }}" role="alert"> {{ isset($msg) ? $msg  : ''}}</div>
            @endif
            
            @if(isset($msg) && isset($err))
                <div class="alert alert-danger {{ isset($msg) ? '' : 'hidden'}} {{ isset($err)? '' : 'hidden' }}" role="alert"> {{ isset($msg) ? $msg  : ''}}</div>
            @endif
           
            @if(!isset($err))
             {!! Form::open(array('route' => 'admin.hardware.savedahdi', 'id'=>'formdahdi')) !!}       
           
            <input type="submit" class="btn btn-primary {{ isset($err)? 'hidden' : '' }}" value="Salvar"/ ><br>

            <h3>System</h3>
            <textarea rows="20" class="filetextarea {{isset($system_conf) ? '' : 'hidden' }} {{ isset($err)? 'hidden' : '' }}" id="system_conf" name="system_conf"> {{isset($system_conf) ? $system_conf : ' '}}</textarea>
            
            <br>
            
            <h3>Channels</h3>   
            <textarea rows="20" class="filetextarea {{ isset($channels_conf) ? '' : 'hidden' }} {{ isset($err)? 'hidden' : '' }}" id="channels_conf" name="channels_conf"> {{isset($channels_conf) ? $channels_conf : ' '}}</textarea>
         
             {!! Form::close() !!}       
            @endif
    </div>
    </div>
  
</div>
  

@push('scripts')

@endpush
        <!-- Simple List -->

<!-- /.row -->
@endsection
