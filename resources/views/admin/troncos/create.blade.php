@extends('admin.base')
@section('content')
<!-- Page Heading -->
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">
            Criar Tronco
        </h1>
        <ol class="breadcrumb">
            <li>
                <i class="fa fa-list"></i>  <a href="{{ route('admin.troncos.index') }}">Listagem</a>
            </li>
            <li class="active">
                <i class="fa fa-plus-circle"></i> Criar tronco
            </li>
        </ol>
    </div>
</div>
<!-- /.row -->
<!-- Page Heading -->
 <div id="myModal" class="modal fade" role="dialog"> <!-- pop up cadência -->
              <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                  <div class="modal-header">
                    <h2 class="modal-title" style='text-align:center'>Criar Tronco</h2>
                  </div>
                  

                  <!--@include('admin/ramais/profiles/') -->
                 
                </div>

             </div>
    </div>
<!-- /.row -->
@endsection