@extends('admin.base')
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Listagem de Grupos
            </h1>
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i>  Grupos
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

    {{-- para carregar listagem normal sem data table --}}
    {{-- @include('admin.accounts.list') --}}

    {{-- para carregar listagem com data table --}}
    @include('admin.groups.datatable')
@endsection
