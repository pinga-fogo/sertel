@extends('admin.base')
@section('content')
        <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
           Cadastrar Hardware
        </h1>
        <ol class="breadcrumb">
            <li class='active'>
                <i class="fa fa-list"></i>  <a href="{{route('admin.troncos.index')}}"> Troncos</a> / Cadastrar Hardware
            </li>
          
        </ol>
    </div>
</div>
<div class="row">
        <div class="panel-body">  
             <div class='col-md-4'>
             {!! Form::open(array('route'=>'admin.hardware.detectkhomp', 'id'=>'formDetectHardware')) !!}       
                <div class="form-group {{isset($final['khomp']) ? '' : 'hidden' }}">
                    <button style='margin-left:29%' type="submit" class="btn btn-sq-lg btn-primary esq">Khomp</button>
                </div>
             {!! Form::close() !!}
             </div>
             <div class='col-md-4'>
             {!! Form::open(array('route'=>'admin.hardware.detectdahdi', 'id'=>'formDetectHardware')) !!}       
                <div class="form-group {{isset($final['dahdi']) ? '' : 'hidden' }}">
                    <button style='margin-left:29%' type="submit" class="btn btn-sq-lg btn-primary dir">Dahdi</button>
                </div>
             {!! Form::close() !!}
             </div>
             <div class='col-md-4'>
             <!--{!! Form::open(array('route'=>'admin.hardware.detectdgv', 'id'=>'formDetectHardware',)) !!} -->
             <form method='post' action="{{route('admin.hardware.detectdgv')}}">   
                {{ csrf_field() }}
                <div class="form-group {{isset($final['dahdi']) ? '' : 'hidden' }}">
                    <button style='margin-left:29%' type="submit" class="btn btn-sq-lg btn-primary dir">Digivoice</button>
                </div>
             </form> 
             {!! Form::close() !!}
            </div>
        </div>
      
<div class="row"> 

</div>
@push('scripts')
<script>
    
</script>
@endpush
        <!-- Simple List -->

<!-- /.row -->
@endsection
