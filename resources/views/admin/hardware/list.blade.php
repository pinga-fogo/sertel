@extends('admin.base')
@section('content')
        <!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Hardwares
        </h1>
        <ol class="breadcrumb">
                <li class="active">
                <i class="fa fa-list"></i>  <a href="{{route('admin.troncos.index')}}"> Troncos</a> / Hardwares
                </li>
            </ol>
    <a href="{{route('admin.hardware.index')}}" class="btn btn-block btn-info"><span class="glyphicon glyphicon-plus"></span> Cadastrar Hardware</a><br>

        <div class=''>
            @include('admin.hardware.hardwareDataTableList')
    </div>
    </div>
  
</div>
  

        <!-- Simple List -->

<!-- /.row -->
@endsection
